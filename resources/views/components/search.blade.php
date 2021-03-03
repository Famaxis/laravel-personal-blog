<div class="margin-top md-4">
    <input type="text" class="form-controller" id="search" name="search" autocomplete="off" placeholder="Search...">
    <div class="search">
    </div>
</div>

<script>
    $('#search').on('keyup', function () {
        $value = $(this).val();
        if ($("#search").val()) {
            $.ajax({
                type: 'get',
                url: '{{ route('search') }}',
                data: {'search': $value},
                success: function (data) {
                    $('.search').slideUp('fast');
                    $('.search').html(data);
                    $('.search').slideDown('fast');
                },
            });
        }
        $('.search').empty();
    });

    $.ajaxSetup({headers: {'csrftoken': '{{ csrf_token() }}'}});
</script>
