<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Notifications\Notifiable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

/**
 * @author Xanders
 * @see https://team.xsamtech.com/xanderssamoth
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'last_connection' => 'datetime:Y-m-d H:i:s',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];

    /**
     * Accessor for Age.
     */
    public function age(): int
    {
        return Carbon::parse($this->attributes['birthdate'])->age;
    }

    /**
     * MANY-TO-MANY
     * Several roles for several users
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class)->withTimestamps()->withPivot('is_selected');
    }

    /**
     * MANY-TO-ONE
     * Several carts for a user
     */
    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class, 'user_id');
    }

    /**
     * MANY-TO-ONE
     * Several paid_funds for a user
     */
    public function paid_funds(): HasMany
    {
        return $this->hasMany(PaidFund::class);
    }

    /**
     * Selected role
     */
    public function getSelectedRoleAttribute()
    {
        return $this->roles()->wherePivot('is_selected', 1)->first();
    }

    /**
     * Check if user is administator
     */
    public function isAdmin()
    {
        $selectedRole = $this->selected_role;

        // Vérifier si le rôle sélectionné est "admin" en prenant en compte la langue
        return $selectedRole && $selectedRole->getTranslation('role_name', 'fr') == 'Administrateur'; 
    }

    /**
     * Unpaid cart
     */
    public function unpaidCart(): HasOne
    {
        return $this->hasOne(Cart::class)->where('is_paid', 0)->latest();
    }

    /**
     * Unpaid orders
     */
    public function unpaidOrders()
    {
        $orders = $this->unpaidCart()->with('customer_orders.product.photos')->first()->customer_orders ?? [];

        // Get user currency
        $userCurrency = $this->currency;

        // Apply currency conversion on each order
        foreach ($orders as $order) {
            $order->converted_price = $order->convertPriceAtThatTime($userCurrency);
        }

        return $orders;
    }

    /**
     * Unpaid cart total
     * 
     * @return float
     */
    public function unpaidCartTotal(): float
    {
        $unpaidCart = $this->unpaidCart()->with('customer_orders')->first();

        // Si le panier existe, calcule le total
        if ($unpaidCart) {
            $userCurrency = $this->currency;

            return $unpaidCart->customer_orders->sum(function ($order) use ($userCurrency) {
                return $order->subtotalPrice($userCurrency);
            });
        }

        return 0;
    }

    /**
     * All customers of user products
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function customers(): HasManyThrough
    {
        return $this->hasManyThrough(User::class, Cart::class, 'user_id', 'id');
    }

    /**
     * All customers of user products with unpaid orders
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function customersWithUnpaidOrders(): HasManyThrough
    {
        return $this->hasManyThrough(User::class, 
                                    Cart::class, 
                                    'user_id', // foreign key in the Cart table
                                    'id', // foreign key in the User table
                                    'id', // primary key of the User table
                                    'user_id' // foreign key in the Cart table
                                    )->whereHas('carts', function ($query) {
                                        $query->where('is_paid', 0);  // Check that the cart is not paid
                                    })->with('carts');  // Adds the baskets for each customer
    }

    /**
     * All customer orders
     * 
     * @param  string $period
     * @param  int $userId
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function myOrders($period = 'daily', $userId = null): Collection
    {
        // Déterminer la plage de dates en fonction du paramètre $period
        $startDate = Carbon::now();
        $endDate = Carbon::now();

        switch ($period) {
            case 'daily':
                $startDate->startOfDay();
                $endDate->endOfDay();
                break;

            case 'weekly':
                $startDate->startOfWeek();
                $endDate->endOfWeek();
                break;

            case 'monthly':
                $startDate->startOfMonth();
                $endDate->endOfMonth();
                break;

            case 'quarterly':
                $startDate->firstOfQuarter();
                $endDate->lastOfQuarter();
                break;

            case 'biannual':
                if ($startDate->month <= 6) {
                    $startDate->firstOfYear();
                    $endDate->endOfMonth(6);

                } else {
                    $startDate->firstOfMonth(7);
                    $endDate->endOfMonth(12);
                }
                break;

            case 'yearly':
                $startDate->firstOfYear();
                $endDate->endOfYear();
                break;

            default:
                throw new \InvalidArgumentException(__('miscellaneous.public.about.subscribe.period.choose'));
        }

        // Récupérer les commandes des produits associés à l'utilisateur dans cette période
        return CustomerOrder::whereHas('product', function ($query) use ($userId) {
                                    // Si un $userId est passé, on filtre sur ce user_id, sinon on ne filtre pas
                                    if ($userId) {
                                        $query->where('user_id', $userId);
                                    }
                                })->whereBetween('created_at', [$startDate, $endDate])
                                ->with(['product', 'product.photos'])  // Charger les produits et leurs photos
                                ->orderByDesc('customer_orders.created_at')->get();
    }

    /**
     * All customers in given period
     * 
     * @param  string $period
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function customersInPeriod($period = 'daily'): Collection
    {
        // Récupérer les commandes des produits associés à l'utilisateur ou à n'importe quel utilisateur
        $orders = $this->myOrders($period, $this->id);

        // Récupérer les utilisateurs (clients) associés aux produits commandés
        $clients = $orders->map(function ($order) {
            return $order->cart->user;  // Récupérer l'utilisateur (client) associé au panier de la commande
        })->unique();  // Utiliser `unique()` pour éviter les doublons

        // Appliquer la conversion des prix en fonction de la devise de l'utilisateur
        foreach ($orders as $order) {
            $userCurrency = $this->currency;

            $order->converted_price = $order->convertPriceAtThatTime($userCurrency);
        }

        return $clients;
    }

    /**
     * Received feedbacks
     */
    public function receivedFeedbacks()
    {
        return $this->hasMany(CustomerFeedback::class, 'for_user_id');
    }

    /**
     * Get readable currency
     * 
     * @return float|null
     */
    public function getReadableCurrencyAttribute(): string|null
    {
        return !empty($this->currency) ? ($this->currency == 'USD' ? '$' : 'FC') : null;
    }

    /**
     * Average feedbacks rating
     * 
     * @return float|null
     */
    public function averageRating(): float|null
    {
        return $this->receivedFeedbacks()->avg('rating');
    }

    /**
     * Check if given product is in the user unpaid cart
     * 
     * @param  int  $productId
     * @return bool
     */
    public function hasProductInUnpaidCart($productId): bool
    {
        return Cart::where('user_id', $this->id)
                        ->where('is_paid', 0)
                        ->whereHas('customer_orders', function ($query) use ($productId) {
                            $query->where('product_id', $productId);
                        })->exists();
    }

    /**
     * Add product to cart
     * 
     * @param  int $productId
     * @param  int $quantity
     * @return \App\Models\CustomerOrder
     */
    public function addProductToCart($productId, $quantity = 1): CustomerOrder
    {
        return DB::transaction(function () use ($productId, $quantity) {
            // 1. Check or create a unpaid cart
            $cart = $this->carts()->where('is_paid', 0)->latest()->first();

            if (!$cart) {
                $cart = $this->carts()->create([
                    'is_paid' => 0,
                ]);
            }

            // 2. Get existing line (or NULL)
            $existingOrder = CustomerOrder::whereHas('cart', function ($q) {
                                                $q->where('user_id', $this->id)->where('is_paid', 0);
                                            })->where('product_id', $productId)->first();

            // 3. Get the product
            $product = Product::findOrFail($productId);

            // 4. Calculation of the total quantity requested (new + existing)
            $totalQuantity = $quantity + ($existingOrder?->quantity ?? 0);

            // 5. Stock verification
            if ($product->quantity < $totalQuantity) {
                throw new \Exception(__('notifications.insufficient_stock', ['product_name' => $product->product_name, 'quantity' => $product->quantity]));
            }

            // 6. If the line already exists, we update its quantity
            if ($existingOrder) {
                $existingOrder->quantity = $totalQuantity;
                $existingOrder->save();

            } else {
                // 7. Create a new order line
                $cart = $this->carts()->where('is_paid', 0)->latest()->first();

                if (!$cart) {
                    $cart = $this->carts()->create(['is_paid' => 0]);
                }

                $existingOrder = $cart->customer_orders()->create([
                    'product_id'         => $product->id,
                    'quantity'           => $quantity,
                    'price_at_that_time' => $product->price,
                    'currency'           => $product->currency,
                ]);
            }

            // 8. Decrement the product quantity by the ordered quantity
            $product->decrement('quantity', $quantity);

            return $existingOrder;
        });
    }

    /**
     * Add product from session to cart
     */
    public function addProductsFromSessionToCart()
    {
        // Récupère les produits en session (panier)
        $cartItems = session()->get('cart', []);

        // Si des produits existent en session
        foreach ($cartItems as $productId => $item) {
            // Ajouter chaque produit au panier de l'utilisateur
            $this->addProductToCart($productId, $item['quantity']);
        }

        // Vider le panier en session après l'ajout
        session()->forget('cart');
    }

    /**
     * Update product quantity from the cart
     * 
     * @param  int $customerOrderId
     * @param  int $quantityChange
     * @param  string $action
     * @return bool
     */
    public function updateProductQuantityInCart($customerOrderId, $quantityChange, $action): bool
    {
        return DB::transaction(function () use ($customerOrderId, $quantityChange, $action) {
            // 1. Get the unpaid cart
            $cart = $this->carts()->where('is_paid', 0)->latest()->first();

            if (!$cart) {
                throw new \Exception(__('notifications.find_cart_404'));
            }

            // 2. Find the order line by its ID
            $existingOrder = $cart->customer_orders()->where('id', $customerOrderId)->first();

            if (!$existingOrder) {
                throw new \Exception(__('notifications.find_customer_order_404'));
            }

            // 3. Get the product related to the order line
            $product = $existingOrder->product;

            switch ($action) {
                case 'increment':
                    // Check if stock is sufficient for increment
                    if ($product->quantity <= 0) {
                        throw new \Exception(__('notifications.insufficient_stock', ['product_name' => $product->product_name, 'quantity' => $product->quantity]));
                    }

                    // Increment quantity in cart
                    $existingOrder->increment('quantity', 1);

                    // Decrease stock
                    $product->decrement('quantity', 1);
                    break;

                case 'decrement':
                    // Check that the quantity in the cart is > 500
                    if ($existingOrder->quantity <= 500) {
                        throw new \Exception(__('notifications.minimum_quantity_error'));
                    }

                    // Decrease quantity in cart
                    $existingOrder->decrement('quantity', 1);

                    // Increment the stock
                    $product->increment('quantity', 1);
                    break;

                case 'update':
                    // Check the new quantity
                    if ($quantityChange < 500) {
                        throw new \Exception(__('notifications.minimum_quantity_error'));
                    }

                    // Update quantity in cart
                    $existingOrder->update(['quantity' => $quantityChange]);

                    // Adjust stock according to the new quantity
                    $stockDifference = $quantityChange - $existingOrder->quantity;

                    if ($stockDifference > 0) {
                        // If we increase the order quantity, check that there is enough product stock
                        if ($product->quantity < $stockDifference) {
                            throw new \Exception(__('notifications.insufficient_stock', ['product_name' => $product->product_name, 'quantity' => $product->quantity]));
                        }

                        // Decrease product stock based on increase
                        $product->decrement('quantity', $stockDifference);

                    } else {
                        // If we decrease the order quantity, increase the product stock
                        $product->increment('quantity', abs($stockDifference));
                    }
                    break;
                default:
                    throw new \Exception(__('validation.custom.action.required'));
            }

            return true; // Indicate that the operation was successful
        });
    }


    /**
     * Remove product from cart
     * 
     * @param  int $customerOrderId
     * @return bool
     */
    public function removeProductFromCart($customerOrderId): bool
    {
        return DB::transaction(function () use ($customerOrderId) {
            // 1. Get the unpaid cart
            $cart = $this->carts()->where('is_paid', 0)->latest()->first();

            if (!$cart) {
                throw new \Exception(__('notifications.find_cart_404'));
            }

            // 2. Find the order line by its ID
            $existingOrder = $cart->customer_orders()->where('id', $customerOrderId)->first();

            if (!$existingOrder) {
                throw new \Exception(__('notifications.find_customer_order_404'));
            }

            // 3. Get the product related to the order line
            $product = $existingOrder->product;

            // 4. Delete the order line from the cart
            $existingOrder->delete();

            // 5. Increment the stock of the product
            $product->increment('quantity', $existingOrder->quantity);

            return true; // Indicate success
        });
    }
}
