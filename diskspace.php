<form method="POST" action="">
select daytime:
<select name="day">
<option value="<?php echo date("Ymd"); ?>"><?php echo date("Ymd"); ?></option>
<option value="<?php echo date("Ymd",strtotime('-1 days')); ?>"><?php echo date("Ymd",strtotime('-1 days')); ?></option>
<option value="<?php echo date("Ymd",strtotime('-2 days')); ?>"><?php echo date("Ymd",strtotime('-2 days')); ?></option>
<option value="<?php echo date("Ymd",strtotime('-3 days')); ?>"><?php echo date("Ymd",strtotime('-3 days')); ?></option>
<option value="<?php echo date("Ymd",strtotime('-4 days')); ?>"><?php echo date("Ymd",strtotime('-4 days')); ?></option>
<option value="<?php echo date("Ymd",strtotime('-5 days')); ?>"><?php echo date("Ymd",strtotime('-5 days')); ?></option>
<option value="<?php echo date("Ymd",strtotime('-6 days')); ?>"><?php echo date("Ymd",strtotime('-6 days')); ?></option>
</select>
<input value="submit" name="submit" type="submit">
</form>
<?php
if ($_POST['submit']){
    $dateday = $_POST['day'];
}else{
$dateday = date("Ymd");
}
$list = array();
foreach(glob("diskspace_logs/*$dateday*.txt") as $f) {
    $list[basename($f,".txt")] = $f;
}
echo "<br/>";
echo "<table border='0'>";
foreach($list as $path){
$filename= $list[basename($path,".txt")];
$str=file_get_contents($filename);
$arr=explode("\n",trim($str));
$i=0;
echo "<tr>";
foreach($arr as $row){
$temp=preg_split('/[\s]+/', $row);
echo "<td>";
if($i>1){
$FreeSpace= sprintf("%.2f", $temp[1]/1073741824);
$Size= sprintf("%.2f", $temp[2]/1073741824);
$syl=round((1-($FreeSpace/$Size))*100).'%';
if($FreeSpace <= "5"){
echo $temp[0]."--<strong style='background:red'>".$FreeSpace."</strong> --".$Size."--".$syl."&nbsp;";
}else{
echo $temp[0]."--".$FreeSpace."--".$Size."--".$syl."&nbsp;";
}
}elseif($i==0){
echo $temp[0]."&nbsp;&nbsp;";
}
$i++;
echo "</td>";
}
echo "</tr>";
}
echo "</table>";
?>
