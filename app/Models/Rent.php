namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    protected $fillable = [
        'customer_id',
        'car_id',
        'tanggal_sewa',
        'tanggal_kembali',
        'harga_sewa',
        'with_driver',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
