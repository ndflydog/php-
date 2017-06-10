<?php
include dirname(__DIR__).'/vendor/autoload.php';

use PHPExcel;

$filename = '/home/fly/share/maja_traffic.txt';
if (!file_exists($filename)) {
    exit('文件不存在');
}
$fileContent = file_get_contents($filename);
$fileArr = explode(PHP_EOL, $fileContent);
array_shift($fileArr);

function createGroupXls($filename = null, array $data = [])
{
    $filename = $filename ? $filename : 'theExcel';
    $objPHPExcel = new PHPExcel();
    $objPHPExcel->getProperties()->setCreator("maja")
        ->setLastModifiedBy("maja")
        ->setTitle("Office 2007 XLSX Test Document")
        ->setSubject("Office 2007 XLSX Test Document")
        ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
        ->setKeywords("office 2007 openxml php")
        ->setCategory("Test result file");

    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A1', 'gid')
        ->setCellValue('B1', '游戏名')
        ->setCellValue('C1', 'ip')
        ->setCellValue('D1', '进程')
        ->setCellValue('E1', '协议');

    $line = 2;
    $wArr = $wArr();
    foreach ($data as $row) {
        $tmpData = explode('--', $row);

        foreach ($tmpData as $v) {
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($wArr[$i++].$line, $v['name'])
                ->setCellValue($wArr[$i++].$line, $v['qq'])
                ->setCellValue($wArr[$i++].$line, $v['phone'])
                ->setCellValue($wArr[$i++].$line, $v['yy']);
        }
        $line++;
    }

    $objPHPExcel->getActiveSheet()->setTitle($filename);

    $objPHPExcel->setActiveSheetIndex(0);


    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
    header('Cache-Control: max-age=0');

    $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save('php://output');
}

function w()
{
    return [
        'A',
        'B',
        'C',
        'D',
        'E',
        'F',
        'G',
        'H',
        'I',
        'J',
        'K',
        'L',
        'M',
        'N',
        'O',
        'P',
        'Q',
        'R',
        'S',
        'T',
        'U',
        'V',
        'W',
        'X',
        'Y',
        'Z',
        'AA',
        'AB',
        'AC',
        'AD',
        'AE',
        'AF',
        'AG',
        'AH',
        'AI',
        'AJ',
        'AK',
        'AL',
        'AM',
        'AN'
    ];
}
