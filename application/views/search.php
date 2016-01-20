<?php
echo $this->load->view('inc/header');
?>
<div class="container-fluid">
<h3><u>SEARCH RESULT</u></h3>
<table id="myTable" class="table table-striped">
<thead>
    <tr>
        <th>Name</th>
        <th>Age</th>
        <th>Batting Style</th>
        <th>Bowling Style</th>
        <th>Country</th>
        <th>State</th>
        <th>City</th>
        <th>Postalcode</th>
	</tr>
</thead>
<?php
foreach ($data as $val) {
	echo "<tr><td><a href='".base_url()."welcome/view_profile/".$val['id']."'>".$val['fullname']."</a></td><td>".$val['age']."</td><td>".$val['battingstyle']."</td><td>".$val['bowlingstyle']."</td><td>".$val['country']."</td><td>".$val['state']."</td><td>".$val['city']."</td><td>".$val['postal']."</td></tr>";
}
?>
</table>
</div>
<?php
echo $this->load->view('inc/footer');
?>
<script src="<?=site_url()?>public/js/datatable.js"></script>
<script type="text/javascript">
    $('#myTable').DataTable();
</script>