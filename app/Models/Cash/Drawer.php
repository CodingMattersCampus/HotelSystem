<?php

declare(strict_types = 1);

namespace App\Models\Cash;

use App\Models\Booking\Booking;
use App\Models\User\Employee as Cashier;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

final class Drawer extends Model
{
    protected $guarded = [];
    public const BEGINNING_BALANCE = 5000;

    public function getRouteKeyName()
    {
        return 'code';
    }

    public function cashTransaction(
        Booking $booking,
        string $description,
        float $amount,
        float $cash,
        float $change
    ) : void {
        CashTransaction::create([
            'code'          => Uuid::uuid4()->toString(),
            'drawer'        => $this->code,
            'booking'       => $booking->code,
            'description'   => $description,
            'amount'        => $amount,
            'cash'          => $cash,
            'change'        => $change,
        ]);

        $this->balance += ($cash - $change);
        $this->save();
    }

    public function deduct(float $amount, string $description) : void
    {
        CashTransaction::create([
            'code'          => Uuid::uuid4()->toString(),
            'drawer'        => $this->code,
            'description'   => $description,
            'amount'        => $amount,
            'change'        => $amount,
            'cash'          => 0.00,
        ]);

        $this->balance -= $amount;
        $this->save();
    }

    public static function beginningTransaction(Cashier $cashier, float $amount) : void
    {
        $drawer = self::create([
            'code'          => Uuid::uuid4()->toString(),
            'cashier'       => $cashier->code,
            'balance'       => $amount,
            'start_shift'   => Carbon::now('Asia/Manila'),
        ]);

        CashTransaction::create([
            'code'          => Uuid::uuid4()->toString(),
            'drawer'        => $drawer->code,
            'description'   => "Initial balance",
            'amount'        => $amount,
            'cash'          => $amount,
        ]);
    }

    public static function endTransaction(Cashier $cashier, float $remittedAmount = 0) : void
    {
        $drawer = $cashier->getDrawer();

        $drawer->update([
                'end_shift'     => Carbon::now('Asia/Manila'),
                'remitted'      => true,
                'logged_out'    => true
            ]);

        Remittance::create([
            'code'      => Uuid::uuid4()->toString(),
            'drawer'    => $drawer->code,
            'cashier'   => $cashier->code,
            'amount'    => $drawer->balance - self::BEGINNING_BALANCE,
            'remitted'  => $remittedAmount,
        ]);
    }

    public function cashAdvance(
        Cashier $employee,
        float $amount
    ) : void {
        CashTransaction::create([
            'code'          => Uuid::uuid4()->toString(),
            'drawer'        => $this->code,
            'description'   => "Cash Advance for employee ". $employee->fullname,
            'amount'        => $amount,
            'cash'          => 0,
            'change'        => $amount,
        ]);

        $this->balance -= $amount;
        $this->save();
    }
}
