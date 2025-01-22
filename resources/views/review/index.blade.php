@extends('layouts.app')

@section('content')
    <header class="bg-light py-3">
        <header class="py-3" style="background-color: #A58836; color: #fff;">
            <div class="container text-center">
                <!-- Логотип -->
                <img src="{{ asset('assets/images/logo.png') }}" alt="Almaty Resort" class="mb-3 mx-auto" style="max-width: 150px;">

                <!-- Заголовок -->
                <h1 class="mb-0 text-uppercase" style="font-size: 24px; font-weight: bold;">Отзывы {{$branch_name}}</h1>
            </div>
        </header>
    </header>
    <div class="container mt-5">
        <div id="mainContainer" class="">
            <div class="mb-3">Оцените нас !</div>
                <!-- Звездный рейтинг -->
                <form id="reviewForm" class="container card" method="POST">
                    @csrf
                    <div class="my-3">
                        @for ($i = 1; $i <= 5; $i++)
                            <label for="star-{{ $i }}" class="star-label">
                                <input type="radio" id="star-{{ $i }}" name="rating" value="{{ $i }}" class="d-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-star text-secondary star-svg" viewBox="0 0 16 16">
                                    <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.33-.316.158-.888-.283-.95l-4.898-.696-2.186-4.362c-.183-.366-.68-.366-.863 0l-2.186 4.362-4.898.696c-.441.062-.613.633-.282.95l3.522 3.356-.83 4.73zm4.905-2.767L8 11.187l-.771.396.146-.853-3.177-3.02 4.386-.622L8 3.64l1.416 2.868 4.386.622-3.177 3.02.146.853L8 11.187l-.229.896z"/>
                                </svg>
                            </label>
                        @endfor
                    </div>
                    <div id="reasonArea" class="d-none">
                        <ul class="list-unstyled">
                            @foreach($reviewReasons as $id => $reason)
                                <li class="mb-2">
                                    <label class="d-flex align-items-center">
                                        <input type="radio" name="reason_id" value="{{ $id }}" class="me-2">
                                        {{ $reason }}
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div id="reportFormArea" class="d-none">
                        <div class="mb-3">
                            <input type="text" name="name" class="form-control" placeholder="Имя">
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text">+7</span>
                                <input
                                    type="tel"
                                    name="phone"
                                    class="form-control"
                                    placeholder="(XXX) XXX-XX-XX"
                                    maxlength="15"
                                    pattern="\(\d{3}\) \d{3}-\d{2}-\d{2}"
                                    oninput="formatPhoneNumber(this)">
                            </div>
                        </div>
                        <div class="mb-3">
                            <textarea name="review" class="form-control" rows="3" placeholder="Оставить отзыв..."></textarea>
                        </div>
                    </div>
                    <div id="buttonArea" class="mb-3 mt-3">
                        <button type="submit" class="btn btn-primary" style="background-color: #A58836; border: none;">Отправить</button>
                    </div>
                </form>
        </div>
    </div>

{{--    <footer class="bg-dark text-white py-4 mt-auto">--}}
{{--        <div class="container text-center">--}}
{{--            <p>&copy; {{ date('Y') }} Almaty Resort. Все права защищены.</p>--}}
{{--        </div>--}}
{{--    </footer>--}}

    <script>
        function formatPhoneNumber(input) {
            // Убираем все символы, кроме цифр
            let numbers = input.value.replace(/\D/g, '');

            // Ограничиваем ввод до 10 цифр
            numbers = numbers.slice(0, 10);

            // Форматируем в виде (XXX) XXX-XX-XX
            let formatted = '';
            if (numbers.length > 0) {
                formatted = '(' + numbers.slice(0, 3);
            }
            if (numbers.length >= 4) {
                formatted += ') ' + numbers.slice(3, 6);
            }
            if (numbers.length >= 7) {
                formatted += '-' + numbers.slice(6, 8);
            }
            if (numbers.length >= 9) {
                formatted += '-' + numbers.slice(8, 10);
            }

            // Обновляем значение поля ввода
            input.value = formatted;
        }
        $(document).ready(function () {
            $('input[name="rating"]').on('change', function () {
                const selectedStars = $(this).val(); // Получаем значение выбранной звезды
                console.log(`Вы выбрали ${selectedStars} звезд`);

                // Сброс всех звезд к изначальному цвету
                $('.star-svg').removeClass('text-warning').addClass('text-secondary');

                // Покраска выбранного количества звезд в золотой цвет
                $('.star-label input').each(function () {
                    if ($(this).val() <= selectedStars) {
                        $(this).siblings('.star-svg').removeClass('text-secondary').addClass('text-warning');
                    }
                });

                if (selectedStars < 4) {
                    // Если меньше 4 звезд, показываем reasonArea
                    $('#reasonArea').removeClass('d-none');
                    // Удаляем required у полей внутри reportFormArea
                    $('#reportFormArea').addClass('d-none').find('input, textarea').prop('required', false);
                } else {
                    // Если 4 или больше звезд, скрываем reasonArea и reportFormArea
                    $('#reasonArea').addClass('d-none').find('input, textarea').prop('required', false);
                    $('#reasonArea input[type="radio"]').prop('checked', false); // Сбрасываем выбор в reasonArea
                    $('#reportFormArea').addClass('d-none').find('input, textarea').prop('required', false);
                }
            });

            $('input[name="reason_id"]').on('change', function () {
                const selectedReason = $(this).val(); // Получаем значение выбранной причины

                if ($('input[name="rating"]:checked').val() < 4 && selectedReason === "{{ array_key_last($reviewReasons) }}") {
                    // Показываем reportFormArea и добавляем required
                    $('#reportFormArea').removeClass('d-none').find('input, textarea').prop('required', true);
                } else {
                    // Скрываем reportFormArea и убираем required
                    $('#reportFormArea').addClass('d-none').find('input, textarea').prop('required', false);
                }
            });

            $('input[name="reason_id"]').on('change', function () {
                const selectedReason = $(this).val(); // Получаем значение выбранной причины

                // Если выбрана последняя причина, показываем reportFormArea
                if ($('input[name="rating"]:checked').val() < 4 && selectedReason === "{{ array_key_last($reviewReasons) }}") {
                    $('#reportFormArea').removeClass('d-none').find('input, textarea').prop('required', true);
                } else {
                    // В других случаях скрываем reportFormArea
                    $('#reportFormArea').addClass('d-none').find('input, textarea').prop('required', false);
                }
            });

            $("#reviewForm").on('submit', function (event) {
                event.preventDefault(); // Предотвращаем стандартное поведение (отправку формы)

                // Получаем значения формы
                const rating = $('input[name="rating"]:checked').val();
                const reason_id = $('input[name="reason_id"]:checked').val();
                const name = $('input[name="name"]').val();
                const review = $('textarea[name="review"]').val();
                let phone = $('input[name="phone"]').val();
                phone = `+7 ${phone}`

                // Проверка заполненности обязательных полей
                if (!rating) {
                    alert('Пожалуйста, выберите количество звезд.');
                    return;
                }

                if (rating < 4 && !reason_id) {
                    alert('Пожалуйста, выберите причину.');
                    return;
                }

                if (rating < 4 && reason_id == "{{ array_key_last($reviewReasons) }}" && (!name || !phone || !review)) {
                    alert('Пожалуйста, заполните имя, телефон и отзыв.');
                    return;
                }

                // Если требуется отправка формы на сервер, используем Ajax
                $.ajax({
                    url: "{{route('review.create')}}", // Получаем URL из атрибута action
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}', // CSRF-токен
                        branch_id : {{$branch_id}},
                        rating,
                        reason_id,
                        name,
                        phone,
                        review,
                    },
                    success: function (response) {
                        if(response.success){
                            if(response.is_redirect){
                                $('input[name="rating"]').prop('disabled', true);
                                $('#buttonArea').html(response.success_view);
                            } else {
                                $('#mainContainer').html(response.success_view);

                            }
                        }
                        // Здесь вы можете выполнить дополнительные действия после успешной отправки
                    },
                    error: function (error) {
                        alert('Произошла ошибка при отправке отзыва.');
                    }
                });
            });
        });
    </script>

    <style>
        .star-label {
            cursor: pointer;
        }

        .star-svg {
            transition: color 0.3s;
        }

        input[type="radio"]:checked + .star-svg {
            color: #A58836; /* Цвет выбранной звезды */
        }

    </style>
@endsection
