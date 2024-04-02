<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use setasign\Fpdi\Fpdi;

class PdfController extends Controller
{
    public function adicionarInformacoes(Request $request)
    {
        // Receba os dados do nome e do CPF do usuário (você pode ajustar isso de acordo com sua aplicação)
        $nome = 'Rafael William Malgueiro Badari';
        $cpf = '328.526.128-52';

        // Caminho para o PDF existente
        $pdfPath = public_path('E_book_Checklist_Precificacao.pdf');

        // Crie uma instância do Fpdi
        $pdf = new Fpdi();
        $pdf->setSourceFile($pdfPath);

        // Adicione as informações em todas as páginas
        $pageCount = $pdf->setPageCount($pdf->setSourceFile($pdfPath));
        for ($pageNumber = 1; $pageNumber <= $pageCount; $pageNumber++) {
            $template = $pdf->importPage($pageNumber);
            $pdf->AddPage();
            $pdf->useTemplate($template);

            // Adicione as informações na página
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetXY(20, 10);
            $pdf->Cell(0, 0, "Nome: $nome", 0, 1, 'L');
            $pdf->SetXY(20, 20);
            $pdf->Cell(0, 0, "CPF: $cpf", 0, 1, 'L');
        }

        // Saída do PDF modificado
        $slug = Str::of($nome . $cpf)->slug('-');

        $outputPath = public_path('E_book_Checklist_Precificacao-'.$slug.'.pdf');
        $pdf->Output($outputPath, 'F');

        // Faça o download do PDF modificado ou realize qualquer outra ação desejada
        return response()->download($outputPath);
    }
}
