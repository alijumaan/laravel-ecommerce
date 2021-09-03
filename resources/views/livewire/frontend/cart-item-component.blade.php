<tr x-data="{ show: true }" x-show="show">
    <td class="product-thumbnail">
        <a href="#">
            @if($cartItem->model->firstMedia)
                <img src=""
                     alt="{{ $cartItem->model->name }}" width="70"/>
                <img src="{{ asset('storage/images/products/' . $cartItem->firstMedia->file_name) }}"
                     style="width: 50px;"
                     alt="">
            @else
                <img src="{{ asset('img/no-img.png') }}"
                     alt="{{ $cartItem->model->name }}" width="70"/>
            @endif

        </a>
    </td>
    <td class="product-name">
        <a href="#">{{ $cartItem->model->name }}</a>
    </td>
    <td class="product-price-cart">
        <span class="amount" style="font-size: 16px;">${{ $cartItem->model->price }}</span>
    </td>
    <td class="product-quantity" style="font-size: 16px;">
        <div class="border d-flex align-items-center justify-content-between px-2">
            <span class="text-uppercase text-gray headings-font-family">Quantity</span>
            <a wire:click.prevent="decreaseQuantity('{{ $cartItem->rowId }}')"
                style="cursor: pointer;">
                <i class="fas fa-caret-left"></i>
            </a>
            <span class="text-center">{{ $itemQuantity }}</span>
            <a wire:click.prevent="increaseQuantity('{{ $cartItem->rowId }}', '{{ $cartItem->id }}')"
                style="cursor: pointer;">
                <i class="fas fa-caret-right"></i>
            </a>
        </div>
    </td>
    <td>
        <p class="mb-0">${{ ($cartItem->model->price) * ($cartItem->qty) }}</p>
    </td>
    <td>
        <a wire:click.prevent="removeFromCart('{{ $cartItem->rowId }}')"
           x-on:click="show = false"
           style="cursor: pointer;">
            <i class="fas fa-trash-alt text-muted"></i>
        </a>
    </td>
</tr>



