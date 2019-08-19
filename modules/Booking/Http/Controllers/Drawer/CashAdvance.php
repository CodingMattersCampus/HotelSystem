<?php

declare(strict_types = 1);

namespace CodingMatters\Booking\Http\Controllers\Drawer;

use App\Models\Cash\CashAdvance as CARequest;
use App\Models\Cash\ApprovalType;
use App\Models\User\Employee;
use CodingMatters\Booking\Http\Requests\CashAdvanceWithdrawRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Session;

final class CashAdvance extends Controller
{
    public function __invoke(CashAdvanceWithdrawRequest $request) : RedirectResponse
    {
        $employee = Employee::whereCode($request->post('employee_code'))->first();
        $cashier = Auth::guard('booking')->user();
        //Do stuff here
        $amount = $request->post('advance_amount');
        $drawer = $cashier->getDrawer();

        $cashadvance = CARequest::create([
            'code'     => Uuid::uuid4()->toString(),
            'drawer'   => $drawer->code,
            'employee' => $employee->code,
            'amount'   => (float) $amount,
            'reason'   => $request->post('reason')
        ]);

        if ($amount < 1000 && $employee) {
            $cashadvance->update([
                'cashier' => $cashier->code,
                'given'   => true,
                'approval' => ApprovalType::APPROVED,
            ]);

            $drawer->cashAdvance($employee, (float) $amount);

            $message = [
                'type' => ApprovalType::APPROVED,
                'msg' => 'Cash Withdrawn',
                'text' => 'Withdrawn ' .
                    $amount . ' cash for ' .
                    $request->post('employee') . ' under grounds of ' .
                    $request->post('reason'),
                ];
        } else {
            $message = [
                'type' => ApprovalType::PENDING,
                'msg' => 'Request Pending',
                'text' => 'Submitted for approval of ' .
                    $amount . ' cash advance for ' .
                    $request->post('employee') . ' under grounds of ' .
                    $request->post('reason'),
                ];
        }

        Session::flash('success', $message);

        return redirect()->route('booking.cash.advance');
    }
}
