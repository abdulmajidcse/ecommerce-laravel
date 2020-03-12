<form action="{{ url('/carts/store/'.$product->id) }}" method="POST">
	@csrf
	<button class="btn btn-outline-dark" type="submit"><i class="fas fa-cart-plus mr-2"></i>Add to cart</button>
</form>