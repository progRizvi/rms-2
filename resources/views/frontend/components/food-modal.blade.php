<style>
    icon-shape {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        vertical-align: middle;
    }

    .icon-sm {
        width: 2rem;
        height: 2rem;

    }
</style>

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header position-relative">
            <img src="{{ asset('uploads/food/' . $food->image) }}" alt="" class=" img-fluid">
            <button type="button" class="btn-close position-absolute btn-light" style="top:8px; right:8px"
                data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <h4>{{ $food->title }}</h4>
            <p>{{ $food->description }}</p>
            <p class="fw-bold">TK. {{ $food->price }}</p>
        </div>
        <div style="padding: 10px;border-top: 1px solid gray;">
            <div class="row">

                <div class="col-12">
                    <div class="d-flex justify-content-between">
                        <div class="input-group w-auto justify-content-end align-items-center">
                            <input type="button" value="-"
                                class="button-minus border rounded-circle  icon-shape icon-sm mx-1 "
                                data-field="quantity">
                            <input type="number" step="1" max="10" value="1" name="quantity"
                                class="quantity-field border-0 text-center w-25">
                            <input type="button" value="+"
                                class="button-plus border rounded-circle icon-shape icon-sm " data-field="quantity">
                        </div>
                        <div>
                            <button type="button" class="btn btn-primary add-to-cart">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    function incrementValue(e) {
        e.preventDefault();
        var fieldName = $(e.target).data('field');
        var parent = $(e.target).closest('div');
        var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

        if (!isNaN(currentVal)) {
            parent.find('input[name=' + fieldName + ']').val(currentVal + 1);
        } else {
            parent.find('input[name=' + fieldName + ']').val(0);
        }
    }

    function decrementValue(e) {
        e.preventDefault();
        var fieldName = $(e.target).data('field');
        var parent = $(e.target).closest('div');
        var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

        if (!isNaN(currentVal) && currentVal > 0) {
            parent.find('input[name=' + fieldName + ']').val(currentVal - 1);
        } else {
            parent.find('input[name=' + fieldName + ']').val(0);
        }
    }

    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });
        $('.add-to-cart').click(function() {
            let foodId = {{ $food->id }};
            let quantity = $('.quantity-field').val();
            $.ajax({
                url: "{{ route('add.to.cart') }}",
                method: "POST",
                data: {
                    food_id: foodId,
                    quantity: quantity
                },
                success: function(response) {
                    console.log(response);
                    if (response.success) {
                        toastr.success(response.message);
                        $('#foodModal').modal('hide');
                    } else {
                        toastr.error("Something went wrong");
                    }
                }
            })
        })

        $('.input-group').on('click', '.button-plus', function(e) {
            incrementValue(e);
        });

        $('.input-group').on('click', '.button-minus', function(e) {
            decrementValue(e);
        });
    })
</script>
