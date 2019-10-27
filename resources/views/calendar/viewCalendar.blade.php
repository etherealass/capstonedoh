@extends('main')

@section('style')

<style type="text/css">

    .dot {
  height: 15px;
  width: 15px;
  border-radius: 50%;
  display: inline-block;
}

</style>
@endsection



@section('content')
<center>
  

      <div class="form-group">
       <div class="form-row">
             <div class="col-md-3">

                  <button type="button" class="btn btn-outline-secondary" style="margin-top: 100px">Secondary</button>

                    <div class="card border-dark mb-3" style="max-width: 18rem; margin-top: 50px;">
                      <div class="card-header" style="background-color: #343a40;color: white">Calendar</div>
                      <div class="card-body text-dark">

                          <p style="text-align: left; margin-left: 20px"><span class="dot"  style="background-color: #32CD32;" ></span>&nbsp;&nbsp;&nbsp;Inpatient Events</p>
                          <p style="text-align: left; margin-left: 20px"><span class="dot"  style="background-color: #428bca;" ></span>&nbsp;&nbsp;&nbsp;Outpatient Events</p>
                          <p style="text-align: left;  margin-left: 20px"><span class="dot"  style="background-color: #5bc0de;" ></span>&nbsp;&nbsp;&nbsp;Aftacare Events</p>
                          <p style="text-align: left;  margin-left: 20px"><span class="dot"  style="background-color: #d9534f;" ></span>&nbsp;&nbsp;&nbsp;Cancelled Events</p>
                          <p style="text-align: left;  margin-left: 20px"><span class="dot"  style="background-color: #f0ad4e;" ></span>&nbsp;&nbsp;&nbsp;Other Events</p>


                        </div>
                    </div>
              </div>
          <div class="col-md-9" style="border: solid black 2px;border-radius: 5px;padding:10px">
            <div id='calendar' style="background-color: white;margin-top: 20px">
            </div>
          </div>
       
  <div class="col-md-2">
     </div>
</div>
</div>
  
  </center>


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
        right: 'month,listWeek'
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

       },
  


      
    });

      })

</script>
@endsection


