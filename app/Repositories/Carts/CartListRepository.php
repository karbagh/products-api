<?php

namespace App\Repositories\Carts;

use App\Models\User;
use App\Models\Cart;
use App\Models\Product;
use App\Repositories\AbstractRepository;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class CartListRepository extends AbstractRepository
{
    public function getWithProductDetails(string $ip, ?User $user = null): ?Cart
    {
        return $user?->cart?->loadProductDetails() ?? Cart::query()
            ->withProductDetails()
            ->where('ip', $ip)
            ->first();
    }

    /**
     * @param string $ip
     * @param User|null $user
     * @return array
     */
    public function getAttributes(string $ip, ?User $user): array
    {
        return [
            'ip' => $ip,
            'user_id' => $user?->id,
        ];
    }

    public function createCart(string $ip, ?User $user = null): Cart
    {
        $attributes = $this->getAttributes($ip, $user);

        Cart::query()->firstOrCreate($attributes)->save();

        return $this->getWithProductDetails($ip, $user);
    }

    public function createCartAndInsertItem(string $ip, Product $product, float $count, ?User $user = null): Cart
    {
        $attributes = $this->getAttributes($ip, $user);

        $cart = $this->getCartOrCreate($user, $attributes, $ip);

        $cart->products()->updateOrCreate(['product_id' => $product->id], [
            'total' => DB::raw("(count + $count) * $product->actualPrice"),
            'count' => DB::raw("count + $count") ,
        ])
            ->save();

        return $cart->loadProductDetails();
    }

    public function changeCountInCart(string $ip, Product $product, float $count, ?User $user = null): Cart
    {
        $attributes = $this->getAttributes($ip, $user);

        $cart = $this->getCartOrCreate($user, $attributes, $ip);

        $cart->products()->updateOrCreate(['product_id' => $product->id], [
            'total' => ($count * $product->actualPrice),
            'count' => $count,
        ])->save();

        return $cart->loadProductDetails();
    }

    public function reduceProductFromCart(string $ip, Product $product, float $count, ?User $user = null): Cart
    {
        $cart = $this->getCartBuilder($user, $ip);

        $item = $cart->products()->where('product_id', $product->id)->firstOrFail();

        if ($item->count > 1 && $item->count > $count) {
            $item->decrement('total', $count * $product->actualPrice);
            $item->decrement('count', $count);
            $item->save();

            return $cart->loadProductDetails();
        } else {
            throw new BadRequestHttpException(trans('cart.reducing.failed'));
        }
    }

    public function removeItemFromList(string $ip, Product $product, ?User $user = null): Cart
    {
        $cart = $this->getCartBuilder($user, $ip);

        $cart->products()->where('product_id', $product->id)->delete();
        return $this->getWithProductDetails($ip, $user);
    }

    public function clear(string $ip, ?User $user = null): void
    {
        $cart = $this->getCartBuilder($user, $ip);

        $cart?->products()->delete();
    }

    /**
     * @param User|null $user
     * @param string $ip
     * @return Cart
     */
    public function getCartBuilder(?User $user, string $ip): Cart
    {
        return $this->getCartOrCreate($user, ['ip' => $ip, 'user_id' => $user?->id],$ip);
    }

    /**
     * @param User|null $user
     * @param array $attributes
     * @param string $ip
     * @return Cart
     */
    public function getCartOrCreate(?User $user, array $attributes, string $ip): Cart
    {
        $cart = $user?->cart()->first();
        $cart?->update(['ip' => $ip]);

        $missingCart = $attributes['user_id']
            ? [['ip' => $attributes['ip']], ['user_id' => $attributes['user_id']]]
            : [['ip' => $attributes['ip']], []];

        return $cart ?? Cart::query()->updateOrCreate(...$missingCart);
    }
}
