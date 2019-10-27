@extends('main')

@section('style')
  <style>

    .eventlist-title { font-size:  40px !important; }


    </style>


@endsection
@section('content')
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Overview</li>
        </ol>

        <!-- Icon Cards--> 
        <div class="row" style="margin-bottom: 0px">
         <div class="col-md-4 col-sm-12 md-10 col-xl-3" style="height: 18rem;">
            <div class="card border-dark md-3 text-black o-hidden h-100">
              <div class="card-body">
                  <p style="font-size: 30px;margin-top: 50px"><i class="fas fa-fw fa fa-user"></i> Patients</p>
                <div class="mr-5"></div>
              </div>
               <a style="color:white" href="{{URL::to('/patient_dep')}}"><button class="btn btn-dark btn-block" style="height: 50px">Create New Patient</button></a>
            </div>
          </div>
          <div class="col-md-9" style="border: solid black 2px;border-radius: 5px;padding:10px">
            <div id="calendar" style="background-color: white;margin-top: 20px"></div>
          </div>
        </div>
      </div>

@endsection

@section('script')
<script type="text/javascript">

  $(function () {

    var evt = [];
     $.ajax({ 
          url:"{{URL::route('getEvent')}}",
          type:"GET",
          dataType:"JSON",
          async:false
    }).done(function(r){

          evt = r;
          evt_color = r.eventColor;
    });
    

    $('#calendar').css('font-size','10px !important');

            
      $("#calendar").fullCalendar({

    //  defaultView: 'listWeek',
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,listWeek'

      },

      eventTextColor: '#FFFFFF',




      minTime: "06:00:00",
      maxTime: "20:00:00",
      events: evt,



      dayClick: function(date, end, jsEvent, view, resourceObj) {

               var current_date = moment().format('MM-DD-YYYY')

              if(current_date <= date.format()) {
               var r = confirm('Do you want to plot on this date ' + date.format());

                if(r== true){


                   var base = '{{ URL::to('/create_event') }}'+'/'+date.format();

                  window.location.href=base;
                }
            
            }
        },

       dayRender: function(date, cell){

             var current_date = moment().format('YYYY-MM-DD');

              if(current_date > date.format()) {

                  cell.css("background", "#e8e8e8");
              }
       
      },

      
       eventClick: function(calEvent, jsEvent, view) {

              var id = calEvent.id;

                var url = '{{ URL::to('/view_event') }}'+'/'+id;

                window.location.href=url;

       }

    });




      })

</script>
@endsection

