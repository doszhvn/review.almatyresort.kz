@extends('layouts.admin')

@section('content')
        <!--begin::App Content-->
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header"><h3 class="card-title">Reports to Director</h3></div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                            <th style="width: 10%;">#</th>
                            <th style="width: 10%;">Rating</th>
                            <th style="width: 20%;">Name</th>
                            <th style="width: 20%;">Phone</th>
                            <th style="width: 40%;">Text</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($reports as $report)
                        <tr class="align-middle">
                          <td>{{$report['review_id']}}</td>
                          <td><span class="badge text-bg-{{$report['from_review']['rating'] < 3 ? 'danger' : ($report['from_review']['rating'] > 3 ? 'success' : 'warning')}}">{{$report['from_review']['rating']}}</span></td>
                          <td>{{$report['name']}}</td>
                          <td>{{$report['phone']}}</td>
                          <td>{{$report['review']}}</td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-end">
                            {{-- Кнопка "Назад" --}}
                            <li class="page-item {{ $reports->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $reports->previousPageUrl() ?? '#' }}">&laquo;</a>
                            </li>

                            {{-- Генерация номеров страниц --}}
                            @for ($i = 1; $i <= $reports->lastPage(); $i++)
                                <li class="page-item {{ $i == $reports->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $reports->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor

                            {{-- Кнопка "Вперед" --}}
                            <li class="page-item {{ $reports->currentPage() == $reports->lastPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $reports->nextPageUrl() ?? '#' }}">&raquo;</a>
                            </li>
                        </ul>
                    </div>
                </div>
              </div>
              <!-- /.col -->
              <!-- /.col -->
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
@endsection
