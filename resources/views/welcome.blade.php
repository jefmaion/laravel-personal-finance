@extends('template.main')

@section('content')

<div class="page-header">
    <div class="container-fluid">
      <h2 class="h5 no-margin-bottom">Dashboard</h2>
    </div>
  </div>
  <section class="no-padding-top no-padding-bottom">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 block">
           
                <table class="table">
                    <thead>
                        <tr>
                            <th>Campo1</th>
                            <th>Campo1</th>
                            <th>Campo1</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope="row"></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td scope="row"></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>

                
            
          </div>
    </div>
  </section>

  
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.13.1/r-2.4.0/datatables.min.css" />
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/v/bs4/dt-1.13.1/r-2.4.0/datatables.min.js"></script>
    <script>
        $('table').DataTable({
        order: [],
        pageLength: 10,
        lengthMenu: [
            [5,10, 25, 50, -1],
            [5,10, 25, 50, 'Tudo'],
        ],
        columnDefs: [
            { className: "align-middle", targets: "_all" },
        ],
        deferRender:true,
        processing:true,
        responsive:true,
        pagingType: $(window).width() < 768 ? 'simple' : 'simple_numbers',
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/pt-BR.json'
        },
    });
    </script>
@endsection