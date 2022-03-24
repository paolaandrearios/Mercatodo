<?php

namespace Tests\Feature;

use App\Request\CreateSessionRequest;
use App\Request\GetInformationRequest;
use App\Services\WebcheckoutService;;
use Tests\TestCase;

class Webcheckout2Test extends TestCase
{
    public function test_it_can_get_information_request()
    {
        $request = (new GetInformationRequest())->auth();
        $this->assertAuthSuccess($request);
    }

    public function test_it_can_get_create_session_request()
    {
        $request = (new CreateSessionRequest($this->getCreateSessionData()))->toArray();
        $this->assertAuthSuccess($request);

        $this->assertArrayHasKey('payment',$request);
        $this->assertArrayHasKey('expiration',$request);
        $this->assertArrayHasKey('locale',$request);
        $this->assertArrayHasKey('returnUrl',$request);
    }

    public function test_it_can_create_session_from_service_correctly()
    {
        $data = $this->getCreateSessionData();
        $response = (new WebcheckoutService())->createSession($data);
//        dd($response);
        $this->assertArrayHasKey('status',$response);
        $this->assertEquals('OK',$response['status']['status']);
        $this->assertArrayHasKey('requestId',$response);
        $this->assertArrayHasKey('processUrl',$response);

        $session_id = $response['requestId'];
        $responseGetSession = $response = (new WebcheckoutService())->getInformation($session_id);

        $this->assertEquals($session_id,$responseGetSession['requestId']);
        $this->assertArrayHasKey('status',$response);
        $this->assertEquals('PENDING',$response['status']['status']);
    }

    public function test_it_get_information_from_service_correctly()
    {

        $session_id = 50870;
        $responseGetSession = $response = (new WebcheckoutService())->getInformation($session_id);

        $this->assertEquals($session_id,$responseGetSession['requestId']);
        $this->assertArrayHasKey('status',$response);
        $this->assertEquals('APPROVED',$response['status']['status']);
    }

    /**
     * @param array $request
     * 50870
     */
    private function assertAuthSuccess(array $request): void
    {
        $this->assertArrayHasKey('auth', $request);
        $this->assertArrayHasKey('login', $request['auth']);
        $this->assertArrayHasKey('tranKey', $request['auth']);
        $this->assertArrayHasKey('nonce', $request['auth']);
        $this->assertArrayHasKey('seed', $request['auth']);
    }

    private function getCreateSessionData(): array
    {
        return [
            'payment' => [
                'reference' => 'TEST_0001',
                'description' => 'conexion con webcheckout desde un test',
                'amount' => [
                    'currency' => 'COP',
                    'total' => '50000'
                ]
            ],
            'returnUrl' => route('client.order.thanks'),
            'expiration' => date('c', strtotime('+2 days')),
        ];
    }
}
