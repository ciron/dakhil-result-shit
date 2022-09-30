<?php
  // require 'vendor/autoload.php';
  // use Dompdf\Dompdf;
         $servername = "localhost";
         $username = "root";
         $password = "";
         $dbname = "excelimport";
         
         // Create connection
         $conn = new mysqli($servername, $username, $password, $dbname);
         if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }
          
          $sql = "SELECT DAKHILA_NO  FROM student_data";
          $result = $conn->query($sql);
         
          class Converter 
            {
                public static $bn = ["১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০"];
                public static $en = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "0"];              

                public static function en2bn($number)
                {
                    return str_replace(self::$en, self::$bn, $number);
                }
            }
        
      ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Dakhil Result report</title>
    <style>
            table, th {
        border: 1px solid black;
        border-collapse: collapse;
      }
      table{
        text-align:center;
      }
      table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
  border-collapse: collapse;
  padding: 2px 15px;
  margin: 2px 15px;
  text-align: center;
}
    </style>
  </head>

  <body>
   
  <button id="myDIV" onclick="display()">Click to Print</button>
       <div class="container">
       <div class="row ">
<?php 
$count = 0;
$counts = 1;
while($count < $result->num_rows){
$var = $count+=20;

$val = $var-19;
// echo $var;
// echo $val;
 $sql1 = "SELECT DAKHILA_NO  FROM student_data WHERE id BETWEEN $val and $var";
 $result1 = $conn->query($sql1);
?>
      
        <div class="col-6 justify-content-center " style=" height:1000px;">
        <table style="font-size:18px;" >
              <tr>
                <th colspan="4">জামিয়াতুস সুন্নাহ</th>
              </tr>
              <tr>
                <th colspan="4">১ম সাময়িক পরীক্ষা : <br>১৪৪২-৪৩ হি :/২০২১-২২ ইং শিক্ষাবর</th>
              </tr>
              <tr>
                <th colspan="4">জামাত : নাহবেমীর-1</th>
              </tr>
              <tr>
                <th colspan="4">নম্বরপত্র </th>
              </tr>
              <tr>
                <th colspan="4">বিষয়: -------</th>
              </tr>
              <tr>                
                <th>ক্রমিক</th>
                <th>দাখিলা</th>
                <th>প্রাপ্ত নম্বর</th>
                <th>মন্তব্য</th>                    
              </tr>
                  <?php 
                  
                  if ($result1->num_rows > 0) {
                      // output data of each row
                      $i = 1;
                      while($row1 = $result1->fetch_assoc()) {
                  ?>
                
                  <tr>
                      <td><?php echo Converter::en2bn($counts++) ?></td>
                      <td><?php echo $row1["DAKHILA_NO"] ?> </td>
                      <td> </td>
                      <td> </td>
                  </tr>
                  <?php
                    }
                  } else {
                    echo "0 results";
                  }
                  ?>
        </table>
       
        </div>
   
        <?php  }?>
        <table style="text-align:left">
          <tr>
            <th>তারিখ:</th>
            <th>পরীক্ষকের পূর্ণ নাম</th>
          </tr>
        </table>
        </div>
       </div>

      

   
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
         function display() {
          document.getElementById("myDIV").style.display = "none";
            window.print();
            document.getElementById("myDIV").style.display = "block";
         }
      </script>
  </body>
</html>