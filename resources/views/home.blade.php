@extends('layouts.app')

@section('title')
    <title>Beranda</title>
@endsection

@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-home icon-gradient bg-mean-fruit"></i>
                </div>
                <div>Beranda
                    <div class="page-title-subheading">
                    </div>
                </div>
            </div>
        </div> 
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3 card">
                <div class="card-header-tab card-header-tab-animation card-header">
                    Persentase Harian
                </div>
                <div class="card-body">
                    <div class="tab-content">
                    <div class="container">
                    <script src="https://code.highcharts.com/highcharts.js"></script>
                    <script src="https://code.highcharts.com/modules/exporting.js"></script>
                    <script src="https://code.highcharts.com/modules/export-data.js"></script>
                    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

                    <figure class="highcharts-figure">
                      <div id="cona"></div>
                    </figure>
                    </div>

                    <script>
                        $(function(){
                                Highcharts.chart('cona', {
                                chart: {
                                    plotBackgroundColor: null,
                                    plotBorderWidth: null,
                                    plotShadow: false,
                                    type: 'pie'
                                },
                                title: {
                                    text: 'Persentase Harian Survei',
                                    align: 'center'
                                },
                                tooltip: {
                                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                                },
                                accessibility: {
                                    point: {
                                    valueSuffix: '%'
                                    }
                                },
                                plotOptions: {
                                    pie: {
                                    allowPointSelect: true,
                                    cursor: 'pointer',
                                    dataLabels: {
                                        enabled: true,
                                        format: '<b>{point.name}</b>'
                                    }
                                    }
                                },
                                series: [{
                                    name: 'Jumlah',
                                    colorByPoint: true,
                                    data: [{
                                    name: 'Sangat Puas',
                                    y: {{$sangatPuas}},
                                    sliced: true,
                                    selected: true
                                    }, {
                                    name: 'Puas',
                                    y: {{$puas}}
                                    },  {
                                    name: 'Biasa Saja',
                                    y: {{$biasaSaja}}
                                    },  {
                                    name: 'Tidak Puas',
                                    y: {{$tidakPuas}}
                                    }]
                                }]
                                });
                        });
                    </script>
                    </div>
                </div> 
            </div>
        </div> 
        <div class="col-md-6">
            <div class="mb-3 card">
                <div class="card-header-tab card-header-tab-animation card-header">
                    Rekap Data Per Tanggal
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="table-responsive">
                            <table id="myTable3" class="table table-striped table-hover" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tanggal</th>
                                        <th>SP</th>
                                        <th>P</th>
                                        <th>BS</th>
                                        <th>TP</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $no=1;
                                    @endphp
                                    @foreach($dataPerTanggal as $tanggal)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$tanggal->tanggal}}</td>
                                        <td>{{$tanggal->nilai_4}}</td>
                                        <td>{{$tanggal->nilai_3}}</td>
                                        <td>{{$tanggal->nilai_2}}</td>
                                        <td>{{$tanggal->nilai_1}}</td>
                                        <td>{{$tanggal->total}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> 
            </div>
        </div>    
    </div>
</div>
@endsection