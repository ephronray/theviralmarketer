<?php
include_once '../_libs/dbConnect.php';
$con = new  dbConnect();
if(!$con->isLoggedIN()){
    $con->redirectMe($newsifyObj->base_url.'/login.php');
}

unset($_SESSION['new_refferals']);
$is_root = $_SESSION['user']['is_root'];
$my_ibm = $_SESSION['user']['ibm'];
$referrals = array();
function referral_html($referals)
{
	$html = '';
	foreach($referals AS $ref_all)
	{
		foreach($ref_all AS $ref)
		{
			$html.= '
			<tr class="odd gradeX">
				<td>' . $ref['level'] . '</td>
				<td>' . $ref['referal_ibm'] . '</td>
				<td>' . $ref['referal_name'] . '</td>
				<td>' . $ref['email'] . '</td>
				<td>' . $ref['refered_by'] . '</td>
			</tr>';
		}
	}
	return $html;
}

function get_details($ibm)
{
	$obj = new  dbConnect();
	$result2 = $obj->db_select("SELECT * FROM members WHERE ibm='" . $ibm . "'");
	$count = mysqli_num_rows($result2);
	if ($count > 0)
	{
		$ref = mysqli_fetch_array($result2);
		return array(
			'name' => $ref['first_name'] . ' ' . $ref['last_name'],
			'ibm' => $ref['ibm']
		);
	}
}

function show_refferal($level, $ibms)
{
	$level++;
	$referrals = array();
	$odd_ref = array();
	$even_ref = array();
	$obj = new  dbConnect();
	foreach($ibms as $ibm)
	{
		$result2 = $obj->db_select("SELECT * FROM members WHERE refer_ibm='" . $ibm . "' OR passad_up_to='" . $ibm . "'");
		$count = mysqli_num_rows($result2);
		if ($count > 0)
		{
			$counter = 1;
			while ($ref = mysqli_fetch_array($result2))
			{
				
					$current_refferal = array(
						'level' => $level,
						'referal_name' => $ref['first_name'] . ' ' . $ref['last_name'],
						'referal_ibm' => $ref['ibm'],
						'email' => $ref['user_email'],
						'refered_by' => get_details($ibm, $obj) ['name'],
						'refered_by_ibm' => get_details($ibm, $obj) ['ibm']
					);

				if ($ref['refer_ibm'] == $ibm  && empty($ref['passad_up_to']) && $level == 1)  //my real refered
				{
					$odd_ref[] = $current_refferal;
				} else if(!empty($ref['passad_up_to']) && $ref['refer_ibm'] != $ibm) {  // my passed up 
					array_push($referrals, $ref['ibm']); 
				    $current_refferal['refered_by'] = get_details($ref['refer_ibm'], $obj) ['name'].' (PASSED UP TO '.get_details($ref['passad_up_to'], $obj) ['name'].')';
					$even_ref[] = $current_refferal;
					$counter++;
				}
			}
		}
	}

	$_SESSION['new_refferals'][$level] = array_merge_recursive($even_ref, $odd_ref);
	if (count($referrals) > 0)
	{
		show_refferal($level, $referrals);
	}
	else
	{
		echo referral_html($_SESSION['new_refferals']);
	}
}
header("Content-type: application/vnd.ms-excel; name='excel'; charset=utf-8");
header("Content-Disposition: filename=myVrialPassUpMembers.xls");
header("Pragma: no-cache");
header("Expires: 0");	
?>
<html>
<head>
	<title></title>
	<script language="javascript">
$(document).ready(function() {
     $(".botonExcel").click(function(event) {
     $("#datos_a_enviar").val( $("<div>").append( $("#Exportar_a_Excel").eq(0).clone()).html());
     $("#FormularioExportacion").submit();
});
});
</script>
</head>
<body>
<table id="Exportar_a_Excel" border ="1" style="border: 1px solid #000;">
<?php 
$report_columnas 	= 	array
						(						
							'Levels',
							'IBM', 
							'Name', 
							'Email', 
							'Introduced By'
						);
?>
<tr>
<?php  foreach($report_columnas AS $col):
		echo '<td>'.$col.'</td>';
	   endforeach;
?>
</tr>
     <?php show_refferal(0, array($_SESSION['user']['ibm'])); ?>
</table>
</body>
</html>