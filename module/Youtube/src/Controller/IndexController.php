<?php

/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Youtube\Controller;

use Youtube\Model\YoutubeForm;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Zend\Json;

use function GuzzleHttp\json_decode;

class IndexController extends AbstractActionController

{

    public function indexAction()
    {
        $keywords = $this->params()->fromRoute('keywords');

        if (!empty($keywords)) {
            $client = new Client();
            $headers = [
                'part' => 'snippet',
                'q' => $keywords,
                'maxResults' => '25'
            ];
            try {
                $response = $client->request(
                    'GET',
                    'https://www.googleapis.com/youtube/v3/search?key=AIzaSyDz37KtWHsETecshmI5rOk1SCm1ImQy2Tk',
                    $headers
                );
                $body = $response->getBody();
                $results = json_decode((string)$body, true);
                return new viewModel([
                    'results' => $results
                ]);
            } catch (ClientException $e) {
                $error = ["error_code"=> $e->getResponse()->getStatusCode(), "error_phrase" => $e->getResponse()->getreasonPhrase()];
                return new viewModel([
                    'error' => $error
                ]);
            }

        }
    }
}
