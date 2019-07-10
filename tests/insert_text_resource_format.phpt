--TEST--
Check for vtiful presence
--SKIPIF--
<?php if (!extension_loaded("xlswriter")) print "skip"; ?>
--FILE--
<?php
$config = ['path' => './tests'];
$excel = new \Vtiful\Kernel\Excel($config);

$textFile = $excel->fileName("tutorial01.xlsx")
    ->header(['name', 'age']);

$fileHandle = $textFile->getHandle();

$format     = new \Vtiful\Kernel\Format($fileHandle);
$colorStyle = $format->fontColor(\Vtiful\Kernel\Format::COLOR_ORANGE)->toResource();

for ($index = 0; $index < 10; $index++) {
    $textFile->insertText($index+1, 0, 'vikin');
    $textFile->insertText($index+1, 1, 1000, '#,##0', $colorStyle);
}

$filePath = $textFile->output();

var_dump($filePath);
?>
--CLEAN--
<?php
@unlink(__DIR__ . '/tutorial01.xlsx');
?>
--EXPECT--
string(23) "./tests/tutorial01.xlsx"