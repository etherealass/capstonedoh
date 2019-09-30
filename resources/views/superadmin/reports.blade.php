@extends('main')
@section('content')
 <style>

      th {
      text-align: inherit;
      background-color: #343a40;
      color:white;
      }

</style>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{URL::to('/profile')}}">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Reports</li>
        </ol>


      
      <div style="background-color: white;border-radius: 5px;height: 550px">
        <div class="row" style="">
          <div class="col-md-9">
            <div class="text-black o-hidden h-100">
              <div class="card-body">
                  <p style="font-size: 50px">Reports</p> 
              </div>
                @include('flash::message')
            </div>
        </div>
      </div>

      <!--<div style="float:right;margin-bottom: 10px;margin-right: 10px;margin-top: 10px"><a href="{{URL::to('samplecsv')}}"><button class="btn btn-success"><i class="fas fa-fw fa fa-file-csv"></i>CSV</button></a></div>-->


  <div class="container" style="margin-left:0px">
    <div class="row">
    <div class="col-md-6">
    <div class="card" style="max-width: 500px;border-color: gray">
      <div class="card-header"  style="background-color: #343a40;color:white">Generate Reports</div>
        <div class="card-body">
          @if ($errors->any())
            @foreach ($errors->all() as $error)
              <div class="alert alert-danger">{{$error}}</div>
            @endforeach
          @endif
          <form action="{{URL::to('/samplecsv')}}" method="post">
          {{csrf_field()}}
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12" style="margin-bottom: 10px">
                <div class="form-label-group">
                 <select class="form-control" id="report" placeholder="Report" required="required" name="report" style="height: 50px">
                    <option value="" disabled selected hidden>Please choose a Report</option>
                    <option value="Profile Report">Enrollment Profile Report</option>
                    <option value="Accomplishment Report">Monthly Accomplishment Report</option>
                    <option value="Status Report">Status Report</option>
                </select>
                </div>
              </div>
              <div class="col-md-12" style="margin-bottom: 10px">
                <div class="form-label-group">
                 <select class="form-control" id="department" placeholder="Department" required="required" name="department" style="height: 50px">
                    <option value="" disabled selected hidden>Please choose a Department</option>
                  @foreach($deps as $dep)
                    <option value="{{$dep->id}}">{{$dep->department_name}} Department</option>
                  @endforeach
                </select>
                </div>
              </div>
            <div class="col-md-6" style="margin-bottom: 10px">
                <div class="form-label-group">
                 <select class="form-control" id="month" placeholder="Month" required="required" name="month" style="height: 50px">
                    <option value="" disabled selected hidden>Please choose a Month</option>
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
                </div>
              </div>
               <div class="col-md-6" style="margin-bottom: 10px">
                <div class="form-label-group">
                 <select class="form-control" id="year" placeholder="Year" required="required" name="year" style="height: 50px">
                    <option value="" disabled selected hidden>Please choose a Year</option>
                    <option value="2019">2019</option>
                       <option value="2018">2018</option>
    <option value="2017">2017</option>
    <option value="2016">2016</option>
    <option value="2015">2015</option>
    <option value="2014">2014</option>
    <option value="2013">2013</option>
    <option value="2012">2012</option>
    <option value="2011">2011</option>
    <option value="2010">2010</option>
    <option value="2009">2009</option>
    <option value="2008">2008</option>
    <option value="2007">2007</option>
    <option value="2006">2006</option>
    <option value="2005">2005</option>
    <option value="2004">2004</option>
    <option value="2003">2003</option>
    <option value="2002">2002</option>
    <option value="2001">2001</option>
    <option value="2000">2000</option>
    <option value="1999">1999</option>
    <option value="1998">1998</option>
    <option value="1997">1997</option>
    <option value="1996">1996</option>
    <option value="1995">1995</option>
    <option value="1994">1994</option>
    <option value="1993">1993</option>
    <option value="1992">1992</option>
    <option value="1991">1991</option>
    <option value="1990">1990</option>
    <option value="1989">1989</option>
    <option value="1988">1988</option>
    <option value="1987">1987</option>
    <option value="1986">1986</option>
    <option value="1985">1985</option>
    <option value="1984">1984</option>
    <option value="1983">1983</option>
    <option value="1982">1982</option>
    <option value="1981">1981</option>
    <option value="1980">1980</option>
    <option value="1979">1979</option>
    <option value="1978">1978</option>
    <option value="1977">1977</option>
    <option value="1976">1976</option>
    <option value="1975">1975</option>
    <option value="1974">1974</option>
    <option value="1973">1973</option>
    <option value="1972">1972</option>
    <option value="1971">1971</option>
    <option value="1970">1970</option>
    <option value="1969">1969</option>
    <option value="1968">1968</option>
    <option value="1967">1967</option>
    <option value="1966">1966</option>
    <option value="1965">1965</option>
    <option value="1964">1964</option>
    <option value="1963">1963</option>
    <option value="1962">1962</option>
    <option value="1961">1961</option>
    <option value="1960">1960</option>
    <option value="1959">1959</option>
    <option value="1958">1958</option>
    <option value="1957">1957</option>
    <option value="1956">1956</option>
    <option value="1955">1955</option>
    <option value="1954">1954</option>
    <option value="1953">1953</option>
    <option value="1952">1952</option>
    <option value="1951">1951</option>
    <option value="1950">1950</option>
    <option value="1949">1949</option>
    <option value="1948">1948</option>
    <option value="1947">1947</option>
    <option value="1946">1946</option>
    <option value="1945">1945</option>
    <option value="1944">1944</option>
    <option value="1943">1943</option>
    <option value="1942">1942</option>
    <option value="1941">1941</option>
    <option value="1940">1940</option>
    <option value="1939">1939</option>
    <option value="1938">1938</option>
    <option value="1937">1937</option>
    <option value="1936">1936</option>
    <option value="1935">1935</option>
    <option value="1934">1934</option>
    <option value="1933">1933</option>
    <option value="1932">1932</option>
    <option value="1931">1931</option>
    <option value="1930">1930</option>
    <option value="1929">1929</option>
    <option value="1928">1928</option>
    <option value="1927">1927</option>
    <option value="1926">1926</option>
    <option value="1925">1925</option>
    <option value="1924">1924</option>
    <option value="1923">1923</option>
    <option value="1922">1922</option>
    <option value="1921">1921</option>
    <option value="1920">1920</option>
    <option value="1919">1919</option>
    <option value="1918">1918</option>
    <option value="1917">1917</option>
    <option value="1916">1916</option>
    <option value="1915">1915</option>
    <option value="1914">1914</option>
    <option value="1913">1913</option>
    <option value="1912">1912</option>
    <option value="1911">1911</option>
    <option value="1910">1910</option>
    <option value="1909">1909</option>
    <option value="1908">1908</option>
    <option value="1907">1907</option>
    <option value="1906">1906</option>
    <option value="1905">1905</option>
    
                </select>
                </div>
              </div>
            </div>
          </div>
           <input class="btn btn-success" type="submit" value="Generate" style="width:100px;margin-left: 0px">
        </form>
      </div>
    </div>
  </div>
  <div class="col-md-6"> 
    <span class="loader" style="display: none"><img style="margin-left: 210px;margin-top: 120px" src="http://cdnjs.cloudflare.com/ajax/libs/semantic-ui/0.16.1/images/loader-large.gif" alt="processing..." /><br><h6 style="margin-left: 195px;margin-top: 10px">downloading....</h6></span>
  </div>
  </div>
</div>
</div>
  
@endsection