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
                  <div class="card-header"><h3 class="card-title">Reviews</h3></div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                            <th style="width: 10%;">#</th>
                            <th style="width: 10%;">Rating</th>
                            <th style="width: 30%;">Reason</th>
                            <th style="width: 50%;">Comment</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($reviews as $review)
                        <tr class="align-middle">
                          <td>{{$review['id']}}</td>
                          <td><span class="badge text-bg-{{$review['rating'] < 3 ? 'danger' : ($review['rating'] > 3 ? 'success' : 'warning')}}">{{$review['rating']}}</span></td>
                          <td>{{$reasons[$review['reason_id']]??''}}</td>
                          <td>{{$review['upgradeField']}}</td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-end">
                            {{-- Кнопка "Назад" --}}
                            <li class="page-item {{ $reviews->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $reviews->previousPageUrl() ?? '#' }}">&laquo;</a>
                            </li>

                            {{-- Генерация номеров страниц --}}
                            @for ($i = 1; $i <= $reviews->lastPage(); $i++)
                                <li class="page-item {{ $i == $reviews->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $reviews->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor

                            {{-- Кнопка "Вперед" --}}
                            <li class="page-item {{ $reviews->currentPage() == $reviews->lastPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $reviews->nextPageUrl() ?? '#' }}">&raquo;</a>
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
