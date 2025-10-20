<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Auth extends Controller
{
    public function sendOtp()
    {
        helper('sms');

        $mobile = $this->request->getPost('mobile');
        $role = $this->request->getPost('role');

        if (!$mobile) {
            return $this->response->setJSON(['status' => 'error', 'msg' => 'Mobile required']);
        }

        // Generate 6-digit OTP
        $otp = rand(100000, 999999);

        // Store OTP + Role in session
        session()->set([
            'otp' => $otp,
            'otp_mobile' => $mobile,
            'otp_role' => $role,
            'otp_time' => time(),
        ]);

        // Send SMS (use fake alert for dev)
        $response = send_otp_sms($mobile, $otp);

        return $this->response->setJSON(['status' => 'success', 'msg' => 'OTP sent', 'otp' => $otp]); // Remove 'otp' in production
    }

    public function verifyOtp()
    {
        $mobile = $this->request->getPost('mobile');
        $otp = $this->request->getPost('otp');

        $storedOtp = session()->get('otp');
        $storedMobile = session()->get('otp_mobile');
        $otpTime = session()->get('otp_time');

        if (!$storedOtp || !$storedMobile) {
            return $this->response->setJSON(['status' => 'error', 'msg' => 'No OTP session']);
        }

        if (time() - $otpTime > 600) { // 10 mins expiry
            session()->remove(['otp', 'otp_mobile', 'otp_role', 'otp_time']);
            return $this->response->setJSON(['status' => 'error', 'msg' => 'OTP expired']);
        }

        if ($mobile == $storedMobile && $otp == $storedOtp) {
            // Login successful
            $role = session()->get('otp_role');

            // Example session for user
            session()->set('user', [
                'mobile' => $mobile,
                'role' => $role,
                'logged_in' => true
            ]);

            // Clear OTP session
            session()->remove(['otp', 'otp_mobile', 'otp_role', 'otp_time']);

            return $this->response->setJSON(['status' => 'success', 'msg' => 'Login success', 'role' => $role]);
        }

        return $this->response->setJSON(['status' => 'error', 'msg' => 'Invalid OTP']);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
