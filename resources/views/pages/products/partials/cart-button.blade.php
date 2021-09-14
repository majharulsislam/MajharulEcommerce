{{-- Ai $row variable ta all product thke declar deya hoeche row = all product --}}

<form action="{{ route('carts.store') }}" method="post">
	@csrf
	<input type="hidden" name="product_id" value="{{ $row->id }}">
	<button type="button" class="btn btn-info" onclick="addToCard({{ $row->id }})"><i class="fas fa-plus"></i></button>
	
</form>

{{-- Show custom.js file and api route --}}