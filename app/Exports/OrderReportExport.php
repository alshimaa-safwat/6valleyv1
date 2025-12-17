<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class OrderReportExport implements FromView, ShouldAutoSize, WithStyles, WithColumnWidths, WithHeadings, WithEvents
{
    use Exportable;
    
    protected $data;
    
    public function __construct($data) 
    {
        $this->data = $data;
    }
    
    public function view(): View
    {
        return view('file-exports.order-report-export', [
            'data' => $this->data,
        ]);
    }
    
    public function columnWidths(): array
    {
        return [
            'A' => 8,   // SL
            'B' => 18,  // Order ID
            'C' => 12,  // Product Image
            'D' => 38,  // Item Details
            'E' => 15,  // Item Price
            'F' => 16,  // Item Discount
            'G' => 16,  // Total Amount
            'H' => 12,  // Total Pcs
            'I' => 18,  // Product Discount
            'J' => 18,  // Coupon Discount
            'K' => 18,  // Referral Discount
            'L' => 18,  // Shipping Charge
            'M' => 18,  // Shipping Method
            'N' => 16,  // Commission
            'O' => 22,  // Deliveryman Incentive
            'P' => 18,  // Brand 
            'Q' => 15,  // Status
        ];
    }
    
    public function styles(Worksheet $sheet) 
    {
        $totalRows = 3; 
        foreach ($this->data['orders'] as $order) {
            $totalRows += $order->details->count();
        }

        $sheet->getStyle('A1:A2')->getFont()->setBold(true);

        // Header
        $sheet->getStyle('A3:Q3')
            ->getFont()->setBold(true)->getColor()->setARGB('FFFFFF');

        $sheet->getStyle('A3:Q3')->getAlignment()->setWrapText(true);

        $sheet->getStyle('A3:Q3')->getFill()->applyFromArray([
            'fillType' => 'solid',
            'color' => ['rgb' => '063C93'],
        ]);

        // Status column (Q)
        $sheet->getStyle('Q4:Q' . $totalRows)->getFill()->applyFromArray([
            'fillType' => 'solid',
            'color' => ['rgb' => 'FFF9D1'],
        ]);

        $sheet->setShowGridlines(false);

        return [
            'A1:Q' . $totalRows => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['argb' => '000000'],
                    ],
                ],
            ],
        ];
    }

   public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $totalRows = 3;
                foreach ($this->data['orders'] as $order) {
                    $totalRows += $order->details->count();
                }

                $event->sheet->getStyle('A1:Q1')
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                    ->setVertical(Alignment::VERTICAL_CENTER);

                $event->sheet->getStyle('A3:Q' . $totalRows)
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                    ->setVertical(Alignment::VERTICAL_CENTER);

                $event->sheet->getStyle('A2:Q2')
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_LEFT)
                    ->setVertical(Alignment::VERTICAL_CENTER);

                // Merge cells
                $event->sheet->mergeCells('A1:Q1');
                $event->sheet->mergeCells('A2:B2');
                $event->sheet->mergeCells('C2:Q2');

                $event->sheet->getRowDimension(2)->setRowHeight(80);
                $event->sheet->getDefaultRowDimension()->setRowHeight(30);

                // Image rows height
                $currentRow = 4;
                foreach ($this->data['orders'] as $order) {
                    foreach ($order->details as $detail) {
                        $event->sheet->getRowDimension($currentRow)->setRowHeight(55);
                        $currentRow++;
                    }
                }

                // Add images
                $this->addProductImages($event);
            },
        ];
    }

    private function addProductImages($event)
    {
        $currentRow = 4; // Start from first data row
        
        foreach ($this->data['orders'] as $order) {
            foreach ($order->details as $detail) {
                $productDetails = $detail?->productAllStatus ?? json_decode($detail->product_details);
                
                if ($productDetails) {
                    // Get image path using the same method as in HTML
                    $imagePath = getStorageImages(
                        path: $detail?->productAllStatus?->thumbnail_full_url, 
                        type: 'backend-product'
                    );
                    
                    // Check if image path is valid
                    if ($imagePath && $imagePath != '') {
                        try {
                            $drawing = new Drawing();
                            $drawing->setName('Product Image');
                            $drawing->setDescription('Product Image');
                            
                            // Set the image path
                            $drawing->setPath($imagePath);
                            
                            // Set position (Column C, current row)
                            $drawing->setCoordinates('C' . $currentRow);
                            
                            // Set size (50x50 pixels to match avatar-60)
                            $drawing->setWidth(50);
                            $drawing->setHeight(50);
                            
                            // Center the image in cell
                            $drawing->setOffsetX(10);
                            $drawing->setOffsetY(3);
                            
                            // Add to worksheet
                            $drawing->setWorksheet($event->sheet->getDelegate());
                        } catch (\Exception $e) {
                            // If image fails, skip it silently
                        }
                    }
                }
                
                $currentRow++;
            }
        }
    }
    
    public function headings(): array
    {
        return ['1'];
    }
}