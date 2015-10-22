@extends('app')
@section('content')
<div class="container">
 @if (Session::has('message1'))
 <div class="alert alert-info">{{ Session::get('message1') }}</div>
 @endif


 <h1>Counselors Reports</h1>  

 {!! Form::open(array('action' => array('ReportCounselorController@reportByDate'))) !!} 
 <div class="form-group">
  {!! Form::label('start_date', 'Data Inicio:') !!}
  {!! Form::date('start_date', \Carbon\Carbon::now()) !!} 

  {!! Form::label('end_date', 'Data Final:') !!}
  {!! Form::date('end_date', \Carbon\Carbon::now()) !!}

  {!! Form::submit('Gerar Relatório', array('class'=>'btn btn-primary')) !!}
</div>
{!! Form::close() !!}
<hr>

<div id="report" class="btn-group pull-right">
  <form method="post" action="">
    <div id="report" class="btn-group pull-right">
      <input class="btn btn-default" type="submit" name="relTipo_PDF" style="float: right;" value="PDF"></input>
    </div>
  </form>
</div>

<table class="table table-striped table-bordered table-hover">
 <thead>
   <tr class="bg-info">
     <th>Id</th>
     <th>Name</th>
     <th>Email</th>
     <th>Phone</th>
     <th>Church</th>
     <th>Pastor</th>
     <!-- <th colspan="2">Actions</th> -->
   </tr>
 </thead>
 <tbody>
   @foreach ($counselors as $counselor)
   <tr>
     <td>{{ $counselor->id }}</td>
     <td>{{ $counselor->name }}</td>
     <td>{{ $counselor->email }}</td>
     <td>{{ $counselor->phone_cel }}</td>
     <td>{{ $counselor->church }}</td>
     <td>{{ $counselor->pastor }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
{!! $counselors->render() !!}
</div>

<?php
if (isset($_POST['relTipo_PDF']))
{ 
  ob_end_clean();
  include_once('/var/www/html/hopeFestival/resources/reports/phpJasperXml/class/tcpdf/tcpdf.php');
  include_once("/var/www/html/hopeFestival/resources/reports/phpJasperXml/class/PHPJasperXML.inc.php");
  include_once('/var/www/html/hopeFestival/resources/reports/phpJasperXml/setting.php');

  $begindb = $begindb." 00:00:00";
  $enddb = $end_date. "23:59:59";

  print_r($begindb); exit();

  $PHPJasperXML = new PHPJasperXML();
  $PHPJasperXML->debugsql=false;
  $PHPJasperXML->arrayParameter=array(
    "begin"     =>"'".$begindb."'",
    "end"       =>"'".$enddb."'",
    "total"     => $total,
    "date_generation" => date("d/m/Y"),
    "hour_generation" => date("H:i:s"),
    "period" => $start_date." - ".$end_date
 );

  $PHPJasperXML = new PHPJasperXML(); 
  $PHPJasperXML->debugsql=false;
  $PHPJasperXML->arrayParameter=array();
  $PHPJasperXML->load_xml_file("/var/www/html/hopeFestival/resources/reports/counselors/report1.jrxml");
  $PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);
  $PHPJasperXML->outpage("D", "FE2015_relatorio-conselheiros_".date("d/m/Y H:i").".pdf");    //page output method I:standard output  D:Download file
  exit;
}

/*if (isset($_POST["relTipo_PDF"])) {

  print_r("expression"); exit;

  ob_clean();

  include_once('phpJasperXml/class/tcpdf/tcpdf.php');
  include_once("phpJasperXml/class/PHPJasperXML.inc.php");
  include_once ('phpJasperXml/setting.php');       

  $begindb = DateTime::createFromFormat('d/m/Y', $begin);
  $begindb = $begindb->format('Y-m-d')." 00:00:00";

  $enddb = DateTime::createFromFormat('d/m/Y', $end);
  $enddb = $enddb->format('Y-m-d')." 23:59:59";

  $unit_name = strtoupper($unit_name);

  $media = number_format($media,2,'.','');

  $PHPJasperXML = new PHPJasperXML();
  $PHPJasperXML->debugsql=false;
  $PHPJasperXML->arrayParameter=array(
    "begin"     =>"'".$begindb."'",
    "end"       =>"'".$enddb."'",
    "total"     =>number_format($total, 2,',','.'),
    "sum_media"=>  number_format($sum_media, 2,',','.'),  
    "quantity"  =>$quantity,
    "unit_name" =>$unit_name,
    "media" =>$media,
    "date_generation" => date("d/m/Y"),
    "hour_generation" => date("H:i:s"),
    "period" => $begin." - ".$end
    );

  $PHPJasperXML->load_xml_file('phpJasperXml/relatorio-atendimentos.jrxml');

  $PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);
  $PHPJasperXML->outpage("D", "AVANT_relatorio-atendimentos_".date("d/m/Y H:i").".pdf");    //page output method I:standard output  D:Download file
  exit;
}*/
?>
@endsection



