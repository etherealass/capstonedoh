<html>
<head>
<div>
    <p style="float: left;"><img src="http://localhost/capstone/public/images/logo.png" height="100px" width="100px"></p>
    <p style="float: right;"><img src="http://localhost/capstone/public/images/logo3.png" height="100px" width="100px"></p>
    <br><p style="text-align: center">Republic of the Philippines<br> Department of Health<br>
     <b style="font-size: 15px">DANGEROUS DRUGS ABUSE PREVENTION & TREATMENT PROGRAM</b><br>EVERSLEY CHILD SANITARIUM<br>
     <b style="font-size: 15px">CEBU TREAMENT & REHABILITATION CENTER</b> for <b>FEMALES</b><br>
     Jagobiao, Mandaue City, Cebu<br>
     <font size="12px">Telefax #: (032) 238-0650/Cp #:09255548119/Email Add: cebu_trc@yahoo.com.ph</font><br>
     </p>
   <div style="border:solid black 0.7px;width: 100%"></div>
</div>
                  @foreach($pat as $pats)
            <center style="margin-bottom: 5px"><h5>INTAKE FORM</h5></center>
              <div class="row" style="margin-left: 20px;font-size: 12px">
                <div class="col-md-6"><p><b>Client's Name:</b><u style="font-size: 15px">
                  _____________{{$pats->fname}} {{$pats->lname}}_____________</u><span style="float: right;margin-right:100px"><b>Date: </b><u style="font-size: 15px">_______{{$pats->date_admitted}}______</u></span></p></div>
              </div>
              <div class="row" style="margin-left: 20px;font-size: 12px">
                <div class="col-md-6"><p><b>Date of Birth:</b><u style="font-size: 15px">_______{{$pats->birthdate}}_______</u><b><span style="margin-left:30px">Age:</b><u style="font-size: 15px">_____{{\Carbon\Carbon::parse($pats->birthdate)->age}}______</u></span><span style="float: right;margin-right:80px"><b>Marital Status:</b><u style="font-size: 15px">______{{$pats->civil_status}}_____</u></span></p>
              </div>
            </div>
              <div class="row" style="margin-left: 20px;font-size: 12px">
                <div class="col-md-6"><p><b>Home Address: </b><br><br><u style="font-size: 15px">____________________________{{$pats->address->street}} {{$pats->address->barangay}} {{$pats->address->city}}_______________________________</u></p></div>
                @endforeach
                @foreach($patos as $patss)
              <div class="row" style="font-size: 12px">
                <div class="col-md-6"><p><b>Educational Attainment: </b><u style="font-size: 15px">_______{{$patss ->educational_attainment}}_______</u><span style="float: right;margin-right:120px"><b>Employement Status: </b><u style="font-size: 15px">_____{{$patss->employment_status}}____</u></span></p></div>
              </div>
              <div class="row" style="font-size: 12px">
                <div class="col-md-12"><p><b>Name of Spouse: </b><u style="font-size: 15px">__________{{$patss->spouse}}__________</u></p></div>
              </div>
              <div class="row" style="font-size: 12px">
                <div class="col-md-12"><p><b>Parents: </b></p></div>
              </div>
              <div class="row" style="font-size: 12px">
                <div class="col-md-12"><p><b>Father's Name: </b><u style="font-size: 15px">_______{{$patss->father}}_______</u></p></div>
                <div class="col-md-12"><p><b>Mother's Name: </b><u style="font-size: 15px">_______{{$patss->mother}}_______</u></p></div>
              </div>
              <div class="row" style="font-size: 12px">
                <div class="col-md-12"><p><b>Whom to notify in case of emergency: </b><u style="font-size: 15px">________{{$patss->eperson->name}}_______</u></p></div>
              </div>
              <div class="row" style="font-size: 12px">
                <div class="col-md-6"><p><b>Name: </b><u style="font-size: 15px">________{{$patss->eperson->name}}________</u><span style="float: right;margin-right:120px"><b>Relationship: </b><u style="font-size: 15px">________{{$patss->eperson->relationship}}________</u></span></p>
              </div>
              <div class="row" style="font-size: 12px">
                <div class="col-md-4"><p><b>Phone No. (Home): </b><u style="font-size: 15px">___{{$patss->eperson->phone}}___</u><b>Cellphone No.:</b><u style="font-size: 15px">___{{$patss->eperson->cellphone}}___</u><b>Email add: </b><u style="font-size: 15px">{{$patss->eperson->email}}</u></p></div>
              </div>
               <div class="row" style="font-size: 12px">
                <div class="col-md-12"><p><b>Presenting Problems: </b><br><u style="font-size: 15px">{{$patss->presenting_problems}}____________________________________________</u></p></div>
              </div>
               <div class="row" style="font-size: 12px">
                <div class="col-md-12"><p><b>Impression: </b><br><u style="font-size: 15px">{{$patss->impression}}____________________________________________</u></p></div>
              </div>
              <div class="row" style="font-size: 12px">
                <div class="col-md-6"><p><b>Intake Officer Signature: </b><u>____________________________</u><span style="float: right;margin-right:120px"><b>Date:</b> <u>____________________________</u></span></p></div>
              </div>
            </div>
            </div>
            @endforeach
          </fieldset>
      </div>
      



</head>
</html>
