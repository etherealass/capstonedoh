<!DOCTYPE html>
<html>
	 <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Patient Referral</title>
<style>
	table {
  border-collapse: collapse;
   padding: 10px;
}

table, th, td {
  border: 1px solid black;
  padding: 8px;
  vertical-align: top;
  text-align: left;
}
</style>
<body>
<div>
    <p style="float: left;"><img src="http://localhost/capstone/public/images/logo.png" height="100px" width="100px"></p>
    <p style="float: right;"><img src="http://localhost/capstone/public/images/logo3.png" height="100px" width="100px"></p>
    <br><p style="text-align: center">Republic of the Philippines<br> Department of Health<br>
     <b style="font-size: 15px">DANGEROUS DRUGS ABUSE PREVENTION & TREATMENT PROGRAM</b><br>EVERSLEY CHILD SANITARIUM<br>
     <b style="font-size: 15px">CEBU TREAMENT & REHABILITATION CENTER</b> for <b>FEMALES</b><br>
     <font style="font-size: 15px;margin-left: 100px">Jagobiao, Mandaue City, Cebu<</p><br>
     <font size="15px">Telefax #: (032) 238-0650/Cp #:09255548119/Email Add: cebu_trc@yahoo.com.ph</font><br>
     </p>
   <div style="border:solid black 0.7px;width: 100%"></div>
</div>
<br>
<center><b>REFFERAL SLIP (TWO WAY REFERRAL SYSTEM)</b></center>
<table width="100%">
@foreach($refers as $refs)
	<tr>
		<td><b>Last Name:</b></td>
		<td>{{$refs->patients->lname}}</td>
		<td colspan="2" rowspan="2"><b>Address: </b>{{$refs->patients->address->street}} {{$refs->patients->address->barangay}} {{$refs->patients->address->city}}</td>
	</tr>
	<tr>
		<td><b>First Name:</b></td>
		<td>{{$refs->patients->fname}}</td>
	</tr>
	<tr>
		<?php $count = 0 ?>
		  @foreach($pat as $pats)
            @foreach($history as $hist)
               @if($hist->type == 'Enrolled' || $hist->type == 'Enrolled from Transfer')
                  @if($hist->deps->department_name == $pats->departments->department_name)
                      <?php $count++; ?>
                    @if($count > 1)
                    <?php $casex = 'Old'?>
                    @else
                    <?php $casex = 'New'?>
                    @endif
                  @endif
                @endif
           	@endforeach
          @endforeach
		<td><b>Case:</b> {{$casex}}</td>
		<td><b>Middle Initial: </b>{{$refs->patients->mname}}</td>
		<td><b>Contact Number:</b></td>
		<td>{{$refs->patients->contact}}</td>
	</tr>
	<tr>
		<td><b>Age</b></td>
		<td>{{\Carbon\Carbon::parse($pats->birthdate)->age}}</td>
		<td><b>Gender</b></td>
		<td>{{$pats->genders->name}}</td>
	</tr>
	<tr>
		<td><b>Birthdate:</b></td>
		<td>{{\Carbon\Carbon::parse($pats->birthdate)->format('M-j-Y')}}</td>
		<td><b>Date of Referral</b></td>
		<td>{{$refs->ref_date}}</td>
	</tr>
	<tr>
		<td><b>Referred at:</b></td>
		<td>{{$refs->ref_at}}</td>
		<td><b>Reasons for Referral:</b></td>
		<td>{{$refs->ref_reason}}</td>
	</tr>
	<tr>
		<td><b>Contact Person:</b></td>
		<td>{{$refs->contact_person}}</td>
		<td><b>Referred by:</b></td>
		<td>{{$refs->users->fname}} {{$refs->users->lname}}</td>
	</tr>
	<tr>
		<td colspan="4"><b>Recommendation/Attachments: </b>{{$refs->recommen}}</td>
	</tr>
	<tr>
		<td><b>Referred back on:</b></td>
		<td>{{$refs->ref_back_date}}</td>
		<td><b>Referred back by:</b></td>
		<td>{{$refs->ref_back_by}}</td>
	</tr>
	<tr>
		<td><b>Accepted by:</b></td>
		<td>{{$refs->accepted_bys->fname}} {{$refs->accepted_bys->lname}}</td>
		<td><b>Referral slip return on:</b></td>
		<td>{{$refs->ref_slip_return}}</td>
	</tr>
@endforeach
</table>
</body>
</html>