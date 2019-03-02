  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  <!-- Page level plugin JavaScript-->
  <script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>
  <script src="{{asset('vendor/datatables/jquery.dataTables.js')}}"></script>
  <script src="{{asset('vendor/datatables/dataTables.bootstrap4.js')}}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{asset('js/sb-admin.min.js')}}"></script>
  <script src="{{asset('js/bootbox.min.js')}}"></script>

  <!-- Demo scripts for this page-->
  <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
  <script src="{{asset('js/demo/chart-area-demo.js')}}"></script>

   <script>
    $('#flash-overlay-modal').modal();
    </script>
    
  <script type="text/javascript">
  
    $(window).load(function() {
      $(".loader").fadeOut("slow");
      })
  
  </script>


<script> 
  
  $('#editModal').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var userid = button.data('userid')
    var fname = button.data('fname')
    var lname = button.data('lname')
    var username = button.data('uname')
    var email = button.data('email')
    var contact = button.data('contact')
    var department = button.data('department')
    var modal = $(this)

    modal.find('.modal-body #userid').val(userid);
    modal.find('.modal-body #fname').val(fname);
    modal.find('.modal-body #lname').val(lname);
    modal.find('.modal-body #username').val(username);
    modal.find('.modal-body #email').val(email);
    modal.find('.modal-body #contact').val(contact);
    modal.find('.modal-body #department').val(department);
  })

  $('#deleteModal').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var user_id = button.data('userid')
    var modal = $(this)

    modal.find('.modal-body #user_id').val(user_id);
  })

  $('#deleteRole').on('show.bs.modal', function (event) {

    var a = $(event.relatedTarget)

    var role = a.data('role')
    var modal = $(this)

    modal.find('.modal-body #role').val(role);
  })

  $(function() {
  $('input[id="case"]').on('click', function(){
    if ($(this).val() == 'With Court Case') {
      $('#textboxes').show();
    }
    else {
      $('#textboxes').hide();
    }
  });
});

  $(function() {
  $('input[id="new case"]').on('click', function(){
    if ($(this).val() == 'New Case') {
      $('#textboxes').hide();
    }
    else {
      $('#textboxes').show();
    }
  });
});

  $(function() {
  $('input[id="old case"]').on('click', function(){
    if ($(this).val() == 'Old Case') {
      $('#textboxes').hide();
    }
    else {
      $('#textboxes').show();
    }
  });
});

  $(function() {
  $('input[id="Voluntary Submission"]').on('click', function(){
    if ($(this).val() == 'Voluntary Submission') {
      $('#textbox').hide();
    }
    else {
      $('#textbox').show();
    }
  });
});

  $(function() {
  $('input[id="Compulsory Submission"]').on('click', function(){
    if ($(this).val() == 'Compulsory Submission') {
      $('#textbox').hide();
    }
    else {
      $('#textbox').show();
    }
  });
});

  $(function() {
  $('input[id="others"]').on('click', function(){
    if ($(this).val() == 'Others') {
      $('#textbox').show();
    }
    else {
      $('#textbox').hide();
    }
  });
});
  
</script>