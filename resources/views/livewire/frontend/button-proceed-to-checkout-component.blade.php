<div x-data="{ showButton: @entangle('showButton') }">
    <a x-show="showButton" href="{{ route('checkout.index') }}" class="btn btn-outline-dark">
        Proceed to checkout
        <i class="fas fa-long-arrow-alt-right ml-2"></i>
    </a>
</div>
