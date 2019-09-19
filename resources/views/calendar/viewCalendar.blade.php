@extends('main')


@section('content')
<center>
<div class="col-md-10" style="height: 63rem;">
  <div class="card border-gray mb-3 text-black o-hidden h-100">
   <div class="card-header" style="background-color: #343a40;color:white"><h6>Calendar</h6></div>
   <center>
    <div class="card-body">
    	<div class="col-md-10">
	   <div id='calendar'></div>
	</div>
	</center>
    </div>

  </div>
</div>	</center>

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
    
            
      $("#calendar").fullCalendar({


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

             console.log(current_date);
             

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


