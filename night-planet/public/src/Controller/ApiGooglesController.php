<?php
namespace App\Controller;

use Google_Client;
use Cake\Error\Debugger;
use Google_Service_Analytics;
use App\Controller\AppController;
use Google_Service_AnalyticsReporting;
use Google_Service_AnalyticsReporting_Metric;
use Google_Service_AnalyticsReporting_OrderBy;
use Google_Service_AnalyticsReporting_DateRange;
use Google_Service_AnalyticsReporting_Dimension;
use Google_Service_AnalyticsReporting_ReportRequest;
use Google_Service_AnalyticsReporting_DimensionFilter;
use Google_Service_AnalyticsReporting_GetReportsRequest;
use Google_Service_AnalyticsReporting_DimensionFilterClause;
use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use App\Controller\Component\BatchComponent;
use Cake\I18n\Time;
use Cake\I18n\Date;

class ApiGooglesController extends AppController
{
//     public function index()
//     {

//         // 自動レンダリングを OFF
//         $this->render(false, false);

//         //		// Load the Google API PHP Client Library.
//         //		require_once __DIR__ . '/vendor/autoload.php';

//         session_start();

//         $client = new Google_Client();
//         // $client->setAuthConfig(__DIR__ . '/client_secrets.json');
//         $client->setAuthConfig(CONFIG . 'api_config/client_secrets.json');
//         $client->addScope(Google_Service_Analytics::ANALYTICS_READONLY);

//         // If the user has already authorized this app then get an access token
//         // else redirect to ask the user to authorize access to Google Analytics.
//         if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
//             // Set the access token on the client.
//             $client->setAccessToken($_SESSION['access_token']);

//             // Create an authorized analytics service object.
//             $analytics = new Google_Service_AnalyticsReporting($client);
//             $this->log('$_SESSION[acces_token]1:'.$_SESSION['access_token'], 'debug');
//             $start_date = date("2020-01-01");
//             $end_date   = date("2020-01-01");

//             // Call the Analytics Reporting API V4.
//             $response = $this->getReport($analytics, $start_date, $end_date);
//             $this->log('$_SESSION[access_token]2:'.$_SESSION['access_token'], 'debug');

//             // コンポーネントを参照(コンポーネントを利用する場合)
//             $this->Batch = new BatchComponent(new ComponentRegistry());

//             // タスクの実行
//             $result = $this->Batch->analyticsReport($response);

//             // Print the response.
//             $this->printResults($response);
//         } else {

// //		  $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/oauth2callback.php';
//             $redirect_uri = $_SERVER['REQUEST_SCHEME'].'://' . $_SERVER['HTTP_HOST'] . '/api-googles/oauth2-callback';
//             $this->log($redirect_uri, 'debug');
//             //		  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
//             $this->redirect(filter_var($redirect_uri, FILTER_SANITIZE_URL));
//         }
//     }

    /**
     * Undocumented function 保守用
     *
     * @return void
     */
    public function index()
    {

        // 自動レンダリングを OFF
        $this->render(false, false);

        //		// Load the Google API PHP Client Library.
        //		require_once __DIR__ . '/vendor/autoload.php';

        session_start();

        $client = new Google_Client();
        // $client->setAuthConfig(__DIR__ . '/client_secrets.json');
        $client->setAuthConfig(CONFIG . 'api_config/client_secrets.json');
        $client->addScope(Google_Service_Analytics::ANALYTICS_READONLY);

        // If the user has already authorized this app then get an access token
        // else redirect to ask the user to authorize access to Google Analytics.
        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            // Set the access token on the client.
            $client->setAccessToken($_SESSION['access_token']);

            // Create an authorized analytics service object.
            $analytics = new Google_Service_AnalyticsReporting($client);
            $this->log('$_SESSION[acces_token]1:'.$_SESSION['access_token'], 'debug');

            $moto_start_date = date('2020-02-10');
            $moto_end_date = date('2020-02-10');
            // $moto_start_date = date('2020-02-15');
            // $moto_end_date = date('2020-02-15');

            // コンポーネントを参照(コンポーネントを利用する場合)
            $this->Batch = new BatchComponent(new ComponentRegistry());
            $is = true;
            $count = 0;
            while ($is) {
                $start_date = date("Y-m-d",strtotime($moto_start_date . "+" . $count . " day"));
                $end_date = date("Y-m-d",strtotime($moto_end_date . "+" . $count . " day"));

                // Call the Analytics Reporting API V4.
                $response = $this->getReport($analytics, $start_date, $end_date);
                $this->log('$_SESSION[access_token]2:'.$_SESSION['access_token'], 'debug');

                // タスクの実行
                $result = $this->Batch->analyticsReportHosyu($response,  $start_date, $count);
                $today = date("Y-m-d");
                if (strtotime($start_date) === strtotime($today)) {
                    $is = false;
                }
                $count++;
            }

            // Print the response.
            $this->printResults($response);
        } else {

//		  $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/oauth2callback.php';
            $redirect_uri = $_SERVER['REQUEST_SCHEME'].'://' . $_SERVER['HTTP_HOST'] . '/api-googles/oauth2-callback';
            $this->log($redirect_uri, 'debug');
            //		  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
            $this->redirect(filter_var($redirect_uri, FILTER_SANITIZE_URL));
        }
    }

    /**
     * Queries the Analytics Reporting API V4.
     *
     * @param service An authorized Analytics Reporting API V4 service object.
     * @return The Analytics Reporting API V4 response.
     */
    public function getReport($analytics, $start_date, $end_date)
    {

        // Replace with your view ID, for example XXXX.
        $VIEW_ID = API['GOOGLE_ANALYTICS_VIEW_ID'];

        // ディメンション(データの属性)の設定
        $dimentions = ['ga:pageTitle', 'ga:pagePath','ga:landingPagePath', 'ga:date', 'ga:dayOfWeek', 'ga:dayOfWeekName'];
        $arrayDimensions = [];
        for ( $i = 0; $i < count($dimentions); $i++) {
            $setDimensions = new Google_Service_AnalyticsReporting_Dimension();
            $setDimensions->setName($dimentions[$i]);
            $arrayDimensions[] = $setDimensions;
        }

        $filersArray = array('/okinawa/','/naha/','/nanjo/','/tomigusuku/'
            ,'/itoman/','/haebaru/','/yonabaru/','/urasoe/','/ginowan/'
            ,'/chatan/','/nishihara/','/okinawashi/','/uruma/','/nago/'
            ,'/miyakojima/','/ishigakijima/');

        // キャスト,日記,お知らせ画面を対象外にする
        // 管理画面を対象外にする
        $filter = new Google_Service_AnalyticsReporting_DimensionFilter();
        $filter->setDimensionName("ga:pagePath");
        $filter->setNot(true);
        $filter->setOperator("REGEXP");
        $filter->setExpressions( ["/.*(cast|diary|notice).*/"] );

        // キャスト画面を対象外にする
        $filter2 = new Google_Service_AnalyticsReporting_DimensionFilter();
        $filter2->setDimensionName("ga:pagePathLevel2");
        $filter2->setNot(false);
        $filter2->setOperator("IN_LIST");
        $filter2->setExpressions($filersArray);

        // ステージング環境を対象外にする
        $filter3 = new Google_Service_AnalyticsReporting_DimensionFilter();
        $filter3->setDimensionName("ga:pagePath");
        $filter3->setNot(true);
        $filter3->setOperator("REGEXP");
        $filter3->setExpressions( ["devokiyorugo.work"] );

        $filters = new Google_Service_AnalyticsReporting_DimensionFilterClause();
        $filters->setFilters(array($filter));

        $filters2 = new Google_Service_AnalyticsReporting_DimensionFilterClause();
        $filters2->setFilters(array($filter2));

        $filters3 = new Google_Service_AnalyticsReporting_DimensionFilterClause();
        $filters3->setFilters(array($filter3));

        $arrayFilters[] = array($filters, $filters2, $filters3);

        // ディメンション(データの属性)の設定
        $landingPagePath = new Google_Service_AnalyticsReporting_Dimension();
        $landingPagePath->setName("ga:landingPagePath");

        // Create the DateRange object.
        $dateRange = new Google_Service_AnalyticsReporting_DateRange();
        $dateRange->setStartDate($start_date);
        $dateRange->setEndDate($end_date);

        // Create the Metrics object.
        $sessions = new Google_Service_AnalyticsReporting_Metric();
        $sessions->setExpression("ga:sessions");
        $sessions->setAlias("sessions");

        // Create the Metrics object.（取得する項目を追加する場合は、オブジェクトごと追加する）
        $pageviews = new Google_Service_AnalyticsReporting_Metric();
        $pageviews->setExpression("ga:pageviews");
        $pageviews->setAlias("pageviews");

        // Create the Metrics object.（取得する項目を追加する場合は、オブジェクトごと追加する）
        $users = new Google_Service_AnalyticsReporting_Metric();
        $users->setExpression("ga:users");
        $users->setAlias("users");

        //表示する順番の制御（Metricで指定した値を使う）
        $ordering = new Google_Service_AnalyticsReporting_OrderBy();
        $ordering->setFieldName("ga:date");
        $ordering->setOrderType("VALUE");
        $ordering->setSortOrder("ASCENDING");

        // Create the ReportRequest object.
        $request = new Google_Service_AnalyticsReporting_ReportRequest();
        $request->setViewId($VIEW_ID);
        $request->setDateRanges($dateRange);
        $request->setMetrics(array($sessions,$pageviews,$users));   // 項目のオブジェクトはここに追加する

        $request->setDimensions($arrayDimensions);   // Dimensions
        $request->setDimensionFilterClauses($arrayFilters); // URLをフィルター
        $request->setOrderBys($ordering);                   // 表示順
        //$request->setPageSize(10);   //ページサイズの設定（取得件数）

        $body = new Google_Service_AnalyticsReporting_GetReportsRequest();
        $body->setReportRequests( array( $request) );
        return $analytics->reports->batchGet( $body );
    }

    /**
     * Parses and prints the Analytics Reporting API V4 response.
     *
     * @param An Analytics Reporting API V4 response.
     */
    public function printResults($reports)
    {
        for ($reportIndex = 0; $reportIndex < count($reports); $reportIndex++) {
            $report = $reports[ $reportIndex ];
            $header = $report->getColumnHeader();
            $dimensionHeaders = $header->getDimensions();
            $metricHeaders = $header->getMetricHeader()->getMetricHeaderEntries();
            $rows = $report->getData()->getRows();

            for ($rowIndex = 0; $rowIndex < count($rows); $rowIndex++) {
                $row = $rows[ $rowIndex ];
                $dimensions = $row->getDimensions();
                $metrics = $row->getMetrics();
                for ($i = 0; $i < count($dimensionHeaders) && $i < count($dimensions); $i++) {
                    print($dimensionHeaders[$i] . ": " . $dimensions[$i] . "</br>");
                }
                $this->log($metrics, 'debug');

                for ($j = 0; $j < count($metrics); $j++) {
                    $values = $metrics[$j]->getValues();
                    for ($k = 0; $k < count($values); $k++) {
                        $entry = $metricHeaders[$k];
                        print($entry->getName() . ": " . $values[$k] . "</br>");
                    }
                    $this->log($values, 'debug');
                }
            }
            print('</br></br></br></br>');
            //$this->log($rows,'debug');
            var_dump('"$report:"'.$rows);
        }
    }

    public function oauth2Callback()
    {

        // 自動レンダリングを OFF
        $this->render(false, false);

        //		// Load the Google API PHP Client Library.
        //		require_once __DIR__ . '/vendor/autoload.php';

        // Start a session to persist credentials.
        session_start();

        // Create the client object and set the authorization configuration
        // from the client_secrets.json you downloaded from the Developers Console.
        $client = new Google_Client();
        //$client->setAuthConfig(__DIR__ . '/client_secrets.json');

        // OAuth 2.0 クライアント IDで認証する
        // $client->setAuthConfig(CONFIG . 'api_config/client_secrets.json');
        // サービス アカウントで認証する
        $client->setAuthConfig(CONFIG . 'api_config/service-account-credentials.json');

        // $client->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/oauth2callback.php');
        $client->setRedirectUri($_SERVER['REQUEST_SCHEME'].'://' . $_SERVER['HTTP_HOST'] . '/api-googles/oauth2-callback');
        $client->addScope(Google_Service_Analytics::ANALYTICS_READONLY);

        // Handle authorization flow from the server.
        if (! isset($_GET['code'])) {
            $auth_url = $client->createAuthUrl();

            //		  header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
            $this->redirect(filter_var($auth_url, FILTER_SANITIZE_URL));
        } else {
            $client->authenticate($_GET['code']);
            $_SESSION['access_token'] = $client->getAccessToken();
            //		  $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/';
            $redirect_uri = $_SERVER['REQUEST_SCHEME'].'://' . $_SERVER['HTTP_HOST'] . '/api-googles/';
            //		  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
            $this->redirect(filter_var($redirect_uri, FILTER_SANITIZE_URL));
        }
    }
}
