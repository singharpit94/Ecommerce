<?php
require_once("../resources/config.php");
function redirect_to($url)
{
    header('Location: ' . $url);
}
?>

<?php

$sql = "SELECT * FROM enable";
$query = query($sql);
confirm($query);
$row = fetch_array($query);
$status = $row['status'];
if($status == 0)
{
    header("location: message.php?msg=timeup");
    exit();
}

?>


<?php
if (isset($_POST["e"])) {
    $sql = "SELECT id FROM month2 LIMIT 1";
    $query = query($sql);
    confirm($query);
    if(mysqli_num_rows($query) == 1)
    {
        $row = fetch_array($query);
        echo $row['id'];
    }

    else
        echo "failed";
}

?>




<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection"/>
    <!--Let browser know website is optimized for mobile-->
    <style>



        a:link {
            text-decoration: none;
            color: #ffffff;
        }

        a:visited {
            text-decoration: none;
        }

        a:hover {
            text-decoration: none;
            color: inherit;

        }

        a:active {
            text-decoration: none;
        }
        .all {
            margin: 5px;
            width: 1500px;
            height: 700px;
            text-align: -webkit-left;
            /* letter-spacing: 1px; */
            text-indent: 8px;
            font-family: monospace;
            border-radius: 0;
        }

        .all > div {
            margin: 7px;
            width: 200px;
            height: 200px;
            border: 0px solid;
            float: left;
            background-color: cornflowerblue;

        }

        .monday_head{
            margin-left:0;
            width:200px;
            background-color: #23659E;
            font-family: Ubuntu,sans-serif;
            font-size: 18px;
            height: 30px;
            color: snow;
            text-indent: 8%;
            line-height: 35px;
        }


        .monday_meal{
            margin-left:0;
            padding: 0;
            width:200px;
            background-color: #97e579;
            font-family:"Droid Sans",sans-serif;
            font-size: 13px;
            height: 40px;
            color: #000000;



        }

        .monday_meal1{
            margin-left:0;
            padding: 0;
            width:200px;
            background-color: #97e579;
            font-family:"Droid Sans",sans-serif;
            font-size: 13px;
            height: 45px;
            color: #000000;


        }

        .all .grid-div{
            font-family: Ubuntu, sans-serif;
            font-size: 16px;
        }

        .day_number{
            color: #323232;
            text-align: center;
            width: 40px;
            height: 40px;
            font-size: 18px;

        }


        label{
            color: #101010;
        }


        /* Unchecked styles */
        [type="radio"]:not(:checked) + label:before {
            border-radius: 50%;
            border: 2px solid #39792d;
        }

        [type="radio"]:not(:checked) + label:after {
            border-radius: 50%;
            border: 2px solid #39792d;
            z-index: -1;
            -webkit-transform: scale(0);
            transform: scale(0);
        }

        /* Checked styles */
        [type="radio"]:checked + label:before {
            border-radius: 50%;
            border: 2px solid transparent;
        }

        [type="radio"]:checked + label:after {
            border-radius: 50%;
            border: 2px solid #63bc59;
            background-color: #63bc59;
            z-index: 0;
            -webkit-transform: scale(1.02);
            transform: scale(1.02);
        }

        /* Radio With gap */
        [type="radio"].with-gap:checked + label:before {
            border-radius: 50%;
            border: 2px solid #63bc59;
        }

        [type="radio"].with-gap:checked + label:after {
            border-radius: 50%;
            border: 2px solid #63bc59;
            background-color: #63bc59;
            z-index: 0;
            -webkit-transform: scale(0.5);
            transform: scale(0.5);
        }

        .submitButton{
            background-color: #00796b;
            font-family: Ubuntu,sans-serif;
            font-weight: 600;
            margin: 20px;
            align-content: center;
        }

        .submitButton:hover{
            background-color: #ae4e5e;
        }

        .monday,.tuesday,.wednesday,.thursday,.friday,.saturday,.sunday{
            height: 156px !important;


        }

        .links
        {
            margin: 10px;
            width: 300px;
            height: 35px;
            background-color: rgba(100, 149, 237, 0.64);
            line-height: 35px;
            text-indent: 5%;
            font-family: Ubuntu, sans-serif;
            transition: background-color 0.3s linear;


        }

        .links a{
            color: #242424;
        }
        .links:hover
        {
            background-color: cornflowerblue;
        }




    </style>
    <script src="js/ajax.js"></script>
    <script src="js/main.js"></script>
</head>
<body>
<div class="links">
    <a href="index.php">Back to HomePage</a>
</div>


<form action="fillup.php" method="POST">
<div class="all">
    <div class="monday hoverable z-depth-1">
        <div class="monday_head">Monday</div>
        <div class="monday_meal">Breakfast:Chola Bhatura</div>
        <div class="monday_meal1">Lunch:Fish,matar paneer,french fries</div>
        <div class="monday_meal1">Dinner:Chilli Chicken, Paneer Butter Masala, cold drinks</div>
    </div>
    <div class="tuesday hoverable z-depth-1">
        <div class="monday_head">Tuesday</div>
        <div class="monday_meal">Breakfast:Pasta BournVita</div>
        <div class="monday_meal1">Lunch:Egg curry,chana masala,mixed veg</div>
        <div class="monday_meal1">Dinner:Aloo Dum parantha rasgulla</div>
    </div>
    <div class="wednesday hoverable z-depth-1">
        <div class="monday_head">Wednesday</div>
        <div class="monday_meal">Breakfast:Parantha Matar Chola</div>
        <div class="monday_meal1">Lunch:Rajma,Dahi,salad</div>
        <div class="monday_meal1">Dinner:Chicken Chilly, mushroom,ice cream</div>
    </div>
    <div class="thursday hoverable z-depth-1">
        <div class="monday_head">Thursday</div>
        <div class="monday_meal">Breakfast:BournVita,Sweet Bun, Banana/Egg</div>
        <div class="monday_meal1">Lunch:Fish,Matar Paneer,Dry Aloo Fry</div>
        <div class="monday_meal1">Dinner:Dal Kachori,Dal Kheer</div>
    </div>
    <div class="friday hoverable z-depth-1">
        <div class="monday_head">Friday</div>
        <div class="monday_meal">Breakfast:Chola Bhatura</div>
        <div class="monday_meal1">Lunch:FishPalak paneer,French Fries</div>
        <div class="monday_meal1">Dinner:Chicken Chilly,Mushroom,Cold Drinks</div>
    </div>
    <div class="saturday hoverable z-depth-1">
        <div class="monday_head">Saturday</div>
        <div class="monday_meal">Breakfast:Dal Poori</div>
        <div class="monday_meal1">Lunch:Khichdi,Chokha,Papad</div>
        <div class="monday_meal1">Dinner:Egg Curry,Matar panner,matar chola aloo</div>
    </div>
    <div class="sunday hoverable z-depth-1">
        <div class="monday_head">Sunday</div>
        <div class="monday_meal">Breakfast:DOSA</div>
        <div class="monday_meal1">Lunch:Fish,Chilli Paneer,Matar chola aloo</div>
        <div class="monday_meal1">Dinner:Dal makhani,parantha,gulab jamun</div>
    </div>


    <div class="grid-div hoverable z-depth-1"></div>
    <div class="grid-div hoverable z-depth-1"></div>
    <div class="grid-div hoverable z-depth-1"></div>
    <div class="grid-div hoverable z-depth-1"></div>
    <div class="grid-div hoverable z-depth-1"></div>
    <div class="grid-div hoverable z-depth-1"></div>
    <div class="grid-div hoverable z-depth-1"></div>

    <div class="grid-div hoverable z-depth-1"></div>
    <div class="grid-div hoverable z-depth-1"></div>
    <div class="grid-div hoverable z-depth-1"></div>
    <div class="grid-div hoverable z-depth-1"></div>
    <div class="grid-div hoverable z-depth-1"></div>
    <div class="grid-div hoverable z-depth-1"></div>
    <div class="grid-div hoverable z-depth-1"></div>

    <div class="grid-div hoverable z-depth-1"></div>
    <div class="grid-div hoverable z-depth-1"></div>
    <div class="grid-div hoverable z-depth-1"></div>
    <div class="grid-div hoverable z-depth-1"></div>
    <div class="grid-div hoverable z-depth-1"></div>
    <div class="grid-div hoverable z-depth-1"></div>
    <div class="grid-div hoverable z-depth-1"></div>

    

</div>
    <br>
    <button class="btn waves-effect waves-light submitButton center-align" type="submit" name="action">Submit
        <i class="material-icons right">send</i>
    </button>
</form>
<div id="demo"></div>

<script src="js/jquery.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
<script>
    var d = new Date();
    var days = ["sunday", "monday", "tuesday", "wednesday", "thursday", "friday", "saturday"];
    var class_array = ["", "one", "two", "three", "four", "five", "six", "seven", "eight", "nine", "ten", "eleven", "twelve", "thirteen", "fourteen", "fifteen", "sixteen", "seventeen", "eighteen", "nineteen", "twenty", "twentyone", "twentytwo", "twentythree", "twentyfour", "twentyfive", "twentysix", "twentyseven", "twentyeight", "twentynine", "thirty", "thirtyone"];
    var no_of_days = [31,29,31,30,31,30,31,31,30,31,30,31];
    var e = 1;
    <?php
        $sql = "SELECT * FROM month LIMIT 1";
        $query = query($sql);
        confirm($query);
        $row = fetch_array($query);
        echo "var month =". $row['id'].";";
		 echo "var half =". $row['half'].";";
     ?>

   console.log(half);
   if(half==1){
    var constructedString = month + "/1/2016";
   
    console.log(month);
    console.log(constructedString);
    var d = new Date(constructedString);
	console.log(d.getDay())
    console.log(days[d.getDay()]);
    var element = document.getElementsByClassName(days[d.getDay()]);//returns an array
    var first_div = element[0];
    console.log(first_div);
    var sibling = first_div.nextElementSibling;
    for (var i = 1; i <= 6; ++i)
         var sibling = sibling.nextElementSibling;
    console.log(sibling)
    // sibling contains cell with day 1 for that month
    $day1 = $(sibling);
    $day1.addClass('one');
    $day1.addClass('1');
    $day1.addClass('days');
    $day1.html('<span class="day_number">1</span>');
    $day1.attr('data', 1);
    for (var i = 2; i <= 15; ++i) {
        $day1 = $day1.next();
        $day1.html('<span class="day_number">'+i+'</span>');
        $day1.addClass(class_array[i]);
        $day1.addClass(i.toString());
        $day1.addClass('days');
        $day1.attr('data', i);
    }
    $('.days').css('background-color', '#FBD6D6');

    var days = document.getElementsByClassName("days");

      var dayss = ["sunday", "monday", "tuesday", "wednesday", "thursday", "friday", "saturday"];
    for (var i = 1; i <= no_of_days[month-1]; ++i) {
        var decide= month +"/"+i+"/2016";
		//console.log(decide);
		 var d1 = new Date(decide);
	var f=d1.getDay();
	//console.log(f);
   // console.log(dayss[f]);
	var sd=dayss[f];
	
	console.log(sd);
		var option = "lday" + i;
		var option1 = "dday" + i;
        var radio_id1 = "lveg" + i;
        var radio_id2 = "lnon_veg" + i;
        var radio_id3 = "lnone" + i;
		var radio_id4="dveg"+i;
		var radio_id5="dnon_veg"+i;
		var radio_id6="dnone"+i;
        var content = "<input type='hidden' name='day_number' value='" + i + "' />";
        content += "<br><input type='radio' name='"+option +"' value='2' + id='"+radio_id1+"' checked><label for='"+radio_id1+"'>Veg(Lunch)</label>";
        content += "<br><input type='radio' name='"+option +"' value='3' + id='"+radio_id2+"'><label for='"+radio_id2+"'>Non Veg(Lunch)</label>";
        content += "<br><input type='radio' name='"+option +"' value='1' + id='"+radio_id3+"'><label for='"+radio_id3+"'>None(Lunch)</label>";
		content += "<br><input type='radio' name='"+option1 +"' value='2' + id='"+radio_id4+"' checked><label for='"+radio_id4+"'>Veg(Dinner)</label>";
		content += "<br><input type='radio' name='"+option1 +"' value='3' + id='"+radio_id5+"'><label for='"+radio_id5+"'>Non Veg(Dinner)</label>";
		if(sd!=dayss[3])
		content += "<br><input type='radio' name='"+option1 +"' value='1' + id='"+radio_id6+"'><label for='"+radio_id6+"'>None(Dinner)</label>";
		 
        
        
        $jq_day = $(days[i - 1]);

        $jq_day.append(content);
    }
   }
   else{
	   
	   var constructedString = month + "/16/2016";
	   console.log(month);
    console.log(constructedString);
    var d = new Date(constructedString);
	console.log(d.getDay())
    console.log(days[d.getDay()]);
    var element = document.getElementsByClassName(days[d.getDay()]);//returns an array
    var first_div = element[0];
    console.log(first_div);
    var sibling = first_div.nextElementSibling;
    for (var i = 1; i <= 6; ++i)
         var sibling = sibling.nextElementSibling;
    console.log(sibling)
    // sibling contains cell with day 1 for that month
    $day1 = $(sibling);
    $day1.addClass('one');
    $day1.addClass('1');
    $day1.addClass('days');
    $day1.html('<span class="day_number">16</span>');
    $day1.attr('data', 16);
    for (var i = 17; i <=no_of_days[month-1] ; ++i) {
        $day1 = $day1.next();
        $day1.html('<span class="day_number">'+i+'</span>');
        $day1.addClass(class_array[i]);
        $day1.addClass(i.toString());
        $day1.addClass('days');
        $day1.attr('data', i);
    }
    $('.days').css('background-color', '#FBD6D6');

    var days = document.getElementsByClassName("days");

      var dayss = ["sunday", "monday", "tuesday", "wednesday", "thursday", "friday", "saturday"];
    for (var i = 1; i <= no_of_days[month-1]-15; ++i) {
        j=i+15;
		var decide= month +"/"+j+"/2016";
		//console.log(decide);
		 var d1 = new Date(decide);
	var f=d1.getDay();
	//console.log(f);
   // console.log(dayss[f]);
	var sd=dayss[f];
	
	console.log(sd);
		var option = "lday" + j;
		var option1 = "dday" + j;
        var radio_id1 = "lveg" + j;
        var radio_id2 = "lnon_veg" + j;
        var radio_id3 = "lnone" + j;
		var radio_id4="dveg"+j;
		var radio_id5="dnon_veg"+j;
		var radio_id6="dnone"+j;
        var content = "<input type='hidden' name='day_number' value='" + j + "' />";
        content += "<br><input type='radio' name='"+option +"' value='2' + id='"+radio_id1+"' checked><label for='"+radio_id1+"'>Veg(Lunch)</label>";
        content += "<br><input type='radio' name='"+option +"' value='3' + id='"+radio_id2+"'><label for='"+radio_id2+"'>Non Veg(Lunch)</label>";
        content += "<br><input type='radio' name='"+option +"' value='1' + id='"+radio_id3+"'><label for='"+radio_id3+"'>None(Lunch)</label>";
		content += "<br><input type='radio' name='"+option1 +"' value='2' + id='"+radio_id4+"' checked><label for='"+radio_id4+"'>Veg(Dinner)</label>";
		content += "<br><input type='radio' name='"+option1 +"' value='3' + id='"+radio_id5+"'><label for='"+radio_id5+"'>Non Veg(Dinner)</label>";
		if(sd!=dayss[3])
		content += "<br><input type='radio' name='"+option1 +"' value='1' + id='"+radio_id6+"'><label for='"+radio_id6+"'>None(Dinner)</label>";
		 
        
        
        $jq_day = $(days[i - 1]);

        $jq_day.append(content);
   }
   }

    /*
     $('.days').click(function(){
     $clicked_div = $(this);
     var data = $clicked_div.attr('data');
     var ajax = ajaxObj("POST", "grid.php");
     ajax.onreadystatechange = function () {
     if (ajaxReturn(ajax) == true) {
     $clicked_div.append(ajax.responseText);
     }
     }
     ajax.send("day_number=" + data);

     $clicked_div.off('click');

     });
     */






    /*
     var i = 3;
     var i_string = i.toString();
     var class_string = i_string + " days";
     console.log(class_string);
     var selected_element = document.getElementsByClassName(class_string);
     console.log(selected_element[0]);
     $selected_element = $(selected_element[0]);
     $selected_element.append('ok');

     */
    //$('div.grid-div:not(.days)').html("");


</script>
</body>

</html>