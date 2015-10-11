<?php


function excel(){
    include '/../../../PHPExcel/Classes/PHPExcel.php';
    include '/../../../PHPExcel/Writer/Excel2007.php';
    //或者include 'PHPExcel/Writer/Excel5.php'; 
    $objPHPExcel = new PHPExcel();
    $objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(20);
    $objPHPExcel->getActiveSheet()->getDefaultColumnDimension()->setWidth(15);



    $objPHPExcel->getActiveSheet()->setCellValue('A1', '个人简历');
    $objPHPExcel->getActiveSheet()->mergeCells('A1:E4');


    $objPHPExcel->getActiveSheet()->setCellValue('A4', '姓　　名：');
    $objPHPExcel->getActiveSheet()->setCellValue('A5', '出生年月：');
    $objPHPExcel->getActiveSheet()->setCellValue('A6', '学　　历：');
    $objPHPExcel->getActiveSheet()->setCellValue('A7', '语言等级：');
    $objPHPExcel->getActiveSheet()->setCellValue('A8', '联系电话：');
    $objPHPExcel->getActiveSheet()->setCellValue('A9', '特长或证书：');
    $objPHPExcel->getActiveSheet()->setCellValue('A10', '联系地址：');


    $objPHPExcel->getActiveSheet()->setCellValue('C4', '性    别：');
    $objPHPExcel->getActiveSheet()->setCellValue('C5', '政治面貌: ');
    $objPHPExcel->getActiveSheet()->setCellValue('C6', '专　　业：');
    $objPHPExcel->getActiveSheet()->setCellValue('C7', '第二语言：');
    $objPHPExcel->getActiveSheet()->setCellValue('C8', '电子信箱：');
    $objPHPExcel->getActiveSheet()->setCellValue('B11', 'QQ：');
    $objPHPExcel->getActiveSheet()->setCellValue('D11', 'MSN：');
    $objPHPExcel->getActiveSheet()->mergeCells('D8:E8');
    $objPHPExcel->getActiveSheet()->mergeCells('B9:E9');
    $objPHPExcel->getActiveSheet()->mergeCells('B10:E10');

    $objPHPExcel->getActiveSheet()->setCellValue('A12', '教育背景：');
    $objPHPExcel->getActiveSheet()->setCellValue('A13', '年   月~  年   月');
    $objPHPExcel->getActiveSheet()->setCellValue('A14', '年   月~  年   月');
    $objPHPExcel->getActiveSheet()->setCellValue('C13', '最终学历');
    $objPHPExcel->getActiveSheet()->setCellValue('C14', '培训深造');
    $objPHPExcel->getActiveSheet()->mergeCells('A12:E12');
    $objPHPExcel->getActiveSheet()->mergeCells('A13:B13');
    $objPHPExcel->getActiveSheet()->mergeCells('A14:B14');
    $objPHPExcel->getActiveSheet()->mergeCells('C13:E13');
    $objPHPExcel->getActiveSheet()->mergeCells('C14:E14');



    $objPHPExcel->getActiveSheet()->setCellValue('A15', '工作中的实习经历：');
    $objPHPExcel->getActiveSheet()->setCellValue('A16', '时间');
    $objPHPExcel->getActiveSheet()->setCellValue('C16', '企业');
    $objPHPExcel->getActiveSheet()->setCellValue('E16', '职位');
    $objPHPExcel->getActiveSheet()->setCellValue('A17', '年   月~  年   月');
    $objPHPExcel->getActiveSheet()->setCellValue('A18', '年   月~  年   月');
    $objPHPExcel->getActiveSheet()->setCellValue('A19', '年   月~  年   月');
    $objPHPExcel->getActiveSheet()->mergeCells('A15:E15');
    $objPHPExcel->getActiveSheet()->mergeCells('A16:B16');
    $objPHPExcel->getActiveSheet()->mergeCells('A17:B17');
    $objPHPExcel->getActiveSheet()->mergeCells('A18:B18');
    $objPHPExcel->getActiveSheet()->mergeCells('A19:B19');
    $objPHPExcel->getActiveSheet()->mergeCells('C16:E16');
    $objPHPExcel->getActiveSheet()->mergeCells('C17:E17');
    $objPHPExcel->getActiveSheet()->mergeCells('C18:E18');
    $objPHPExcel->getActiveSheet()->mergeCells('C19:E19');




    $objPHPExcel->getActiveSheet()->getStyle('A1:E19')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A1:E19')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A1:E19')->getFont()->setSize(11);
    $objPHPExcel->getActiveSheet()->getStyle('A5:E19')->getFont()->setNAME('宋体');


    $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
    $styleArray = array(  
        'borders' => array(  
            'allborders' => array(  
                'style' => PHPExcel_Style_Border::BORDER_THIN,//细边框  
                ),  
            ),  
        );  
    $objPHPExcel->getActiveSheet()->getStyle('A1:E19')->applyFromArray($styleArray);//这里就是画出从单元格A5到N5的

    //保存excel—2007格式
    $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
    $objWriter->save("./PHPExcel/Result/test.xlsx");
}

?>