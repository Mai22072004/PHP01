//4. Viết một chương trình PHP để tìm kiếm một chuỗi con trong một chuỗi sử dụng hàm strpos().
<?php 
echo strpos("Đinh Thị Ngọc Mai","Mai");
?>
//7. Viết một chương trình PHP để chuyển đổi một chuỗi thành chữ hoa sử dụng hàm strtoupper().
<?php
$str1 = "Ngọc Mai";
$str2 = strtoupper($str1);
echo $str2;
?>

//9. Viết một chương trình PHP để chuyển đổi một chuỗi thành chuỗi in hoa chữ cái đầu tiên của mỗi từ sử dụng hàm ucwords().
<?php
$str1 = "hellotmu";
echo ucwords($str1);
?>

//14. Viết một chương trình PHP để nối các phần tử của một mảng thành một chuỗi sử dụng hàm implode().
<?php
    $str1 = array("1","2","3");
    $str2 = array("a");
    $str3 = array();

    echo " str1 is: '".implode("','",$a1)."'<br>";  
    echo " str2 is: '".implode("','",$a2)."'<br>";
    echo " str3 is: '".implode("','",$a3)."'<br>";
?>

//16. Viết một chương trình PHP để kiểm tra xem một chuỗi có kết thúc bằng một chuỗi con khác không sử dụng hàm strrchr().
<?php
$str1="Chao mung ban den";
    $char="TMU";
    if(strrchr($str1,$char)===$char){
        echo"Chuỗi kết thúc bằng chuỗi con khác!";
    }
    else{
        echo"Chuỗi không kết thúc bằng chuỗi con khác!";
    }
    echo"<br>";
    ?>

//17. Viết một chương trình PHP để kiểm tra xem một chuỗi có chứa một chuỗi con khác không sử dụng hàm strstr().
<?php
$str1="Xin chào TMU!!!";
$str2="b";
if(strstr($str1,$str2)){
    echo"Chuỗi có chứa một chuỗi con khác!";
}
else{
    echo"Chuỗi không chứa một chuỗi con khác!";
}
echo"<br>";
?>

//18. Viết một chương trình PHP để thay thế tất cả các ký tự trong một chuỗi không phải là chữ cái hoặc số bằng một ký tự khác sử dụng hàm preg_replace().
<?php
$str1="!@#$%^&Maine@#%%";
echo preg_replace("/\W+/","_",$str1);
echo"<br>";
?>
