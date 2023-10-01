<?php

namespace App\Http\Controllers;

use Guest\AddOrderAddon as GuestAddOrderAddon;
use Guest\GuestAddOrderRequest;
use Guest\GuestLoginRequest;
use Guest\GuestMenuRequest;
use Guest\GuestServiceClient;
use Guest\GuestViewOrderRequest;
use Pos\GetCategoryRequest;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Pos\AddCustomerRequest;
use Pos\GetMenuRequest;
use Pos\PosServiceClient;
use Pos\ToggleMenuData;
use Pos\ToggleMenuRequest;
use Pos\UpdateStockData;
use Pos\UpdateStockRequest;
use Pos\ViewCustomerRequest;
use Trx\AddOrderAddon;
use Trx\AddOrderRequest;
use Trx\AdjustmentOrderRequest;
use Trx\NewOrderRequest;
use Trx\TrxServiceClient;
use Trx\ViewHoldOrderDetailRequest;
use Trx\ViewHoldOrderRequest;

class PosController extends Controller
{
    function DoLogin(Request $request) {
        Log::debug('DoLogin');
        $client = new GuestServiceClient(config('moneta.guest.address'), [
            'credentials' => \Grpc\ChannelCredentials::createInsecure(), 
        ]);

        $grpcRequest = new GuestLoginRequest();
        $grpcRequest->setQrcode($request::createFromGlobals()->get('order_id'));

        list($grpcResults, $status) = $client->DoGuestLogin($grpcRequest, ['xid' => ['Moneta v.0.0.1']])->wait();

        $grpcHitStatus = $status->code;

        if ($grpcHitStatus === 0) {
            Log::debug('berhasil bro hitnya');
            if ($grpcResults->getStatus() === '000') {

                foreach ($grpcResults->getResults() as $dataList) {
                    $session = $dataList->getSessionid();
                    $qrcode = $dataList->getQrcode();
                    $clientid = $dataList->getClientid();
                    $storeid = $dataList->getStoreid();
                    $typeid = $dataList->getTypeid();
                    $orderid = $dataList->getOrderid();
                    $orderidsimple = $dataList->getOrderidsimple();
                    $tableno = $dataList->getTableno();
                    $name = $dataList->getName();
                    $tagline = $dataList->getTagline();
                    
                }

                $request->session()->put('session', $session);
                $request->session()->put('qrcode', $qrcode);
                $request->session()->put('clientid', $clientid);
                $request->session()->put('storeid', $storeid);
                $request->session()->put('typeid', $typeid);
                $request->session()->put('orderid', $orderid);
                $request->session()->put('orderidsimple', $orderidsimple);
                $request->session()->put('tableno', $tableno);
                $request->session()->put('name', $name);
                $request->session()->put('tagline', $tagline);

                echo "<script> alert('Successfull with status " . $grpcResults->getStatus() . "'); window.location.href='/customer-order/" . $orderid . "'; </script>";
            } else {
                Log::error($grpcResults->getStatus());
                echo "<script> alert('Error with status " . $grpcResults->getStatus() . "'); window.location.href='error'; </script>";
            }
        } else {
            echo "<script> alert('Error hit with status " . strval($grpcHitStatus) . "'); window.location.href='error'; </script>";
        }
    }
    function DoLoginApi(Request $request) {
        Log::debug('DoLogin');
        $theid = $request->id;
        $client = new GuestServiceClient(config('moneta.guest.address'), [
            'credentials' => \Grpc\ChannelCredentials::createInsecure(), 
        ]);

        $grpcRequest = new GuestLoginRequest();
        $grpcRequest->setQrcode($theid);

        list($grpcResults, $status) = $client->DoGuestLogin($grpcRequest, ['xid' => ['Moneta v.0.0.1']])->wait();

        $grpcHitStatus = $status->code;

        if ($grpcHitStatus === 0) {
            Log::debug('berhasil bro hitnya');
            if ($grpcResults->getStatus() === '000') {

                foreach ($grpcResults->getResults() as $dataList) {
                    $session = $dataList->getSessionid();
                    $qrcode = $dataList->getQrcode();
                    $clientid = $dataList->getClientid();
                    $storeid = $dataList->getStoreid();
                    $typeid = $dataList->getTypeid();
                    $orderid = $dataList->getOrderid();
                    $orderidsimple = $dataList->getOrderidsimple();
                    $tableno = $dataList->getTableno();
                    $name = $dataList->getName();
                    $tagline = $dataList->getTagline();
                    
                }

                $request->session()->put('session', $session);
                $request->session()->put('qrcode', $qrcode);
                $request->session()->put('clientid', $clientid);
                $request->session()->put('storeid', $storeid);
                $request->session()->put('typeid', $typeid);
                $request->session()->put('orderid', $orderid);
                $request->session()->put('orderidsimple', $orderidsimple);
                $request->session()->put('tableno', $tableno);
                $request->session()->put('name', $name);
                $request->session()->put('tagline', $tagline);

                echo "<script> alert('Successfull with status " . $grpcResults->getStatus() . "'); window.location.href='/customer-order/" . $orderid . "'; </script>";
            } else {
                Log::error($grpcResults->getStatus());
                echo "<script> alert('Error with status " . $grpcResults->getStatus() . "'); window.location.href='error'; </script>";
            }
        } else {
            echo "<script> alert('Error hit with status " . strval($grpcHitStatus) . "'); window.location.href='error'; </script>";
        }
    }
    function DoLogout(Request $request) {
        Log::debug('DoLogout');
        $request->session()->flush();
        Auth::logout();
    }

    function CustomerOrder(Request $request) {
        Log::debug('CustomerOrder');

        $holdOrderList = [];

        $client = new TrxServiceClient(config('moneta.trx.address'), [
            'credentials' => \Grpc\ChannelCredentials::createInsecure(), 
        ]);

        $grpcRequest = new ViewHoldOrderRequest();
        $grpcRequest->setPosid(session()->get('sessPosID'));
        $grpcRequest->setStoreid(session()->get('sessStoreID'));
        $grpcRequest->setSession(session()->get('session'));

        list($grpcResults, $status) = $client->DoViewHoldOrder($grpcRequest, ['xid' => ['Moneta v.0.0.1']])->wait();
        $grpcHitStatus = $status->code;

        if ($grpcHitStatus === 0) {
            if ($grpcResults->getStatus() === '000') {
                $request->session()->put('session', $grpcResults->getSession());
                foreach($grpcResults->getResults() as $index) {
                    array_push($holdOrderList, $index->getOrderid());
                }
            } else {
                Log::debug('gagal get hold order '. $grpcResults->getStatus());
                return redirect()->back()->withErrors('Error hold order with status' . $grpcResults->getStatus());
            }
        } else {
            Log::debug('gagal hit');
            return redirect()->back()->withErrors('Error hit hold order with status' . $grpcHitStatus);
        }

        // $grpcRequest = new ViewHoldOrderDetailRequest();
        // $grpcRequest->setOrderid($holdOrderList[0]);
        // $grpcRequest->setPosid(session()->get('sessPosID'));
        // $grpcRequest->setStoreid(session()->get('sessStoreID'));
        // $grpcRequest->setSession(session()->get('session'));
        // list($grpcResults, $status) = $client->DoViewHoldOrderDetail($grpcRequest, ['xid' => ['Moneta v.0.0.1']])->wait();

        // if ($grpcHitStatus === 0) {
        //     if ($grpcResults->getStatus() === '000') {
        //         $request->session()->put('session', $grpcResults->getSession());
        //         foreach($grpcResults->getResults() as $index) {
        //             array_push($menuList, $index);
        //         }
        //     } else {
        //         Log::debug('gagal get menu '. $grpcResults->getStatus());
        //         return redirect()->back()->withErrors('Error menu with status' . $grpcResults->getStatus());
        //     }
        // } else {
        //     Log::debug('gagal hit menu');
        //     return redirect()->back()->withErrors('Error hit menu with status' . $grpcResults->getStatus());
        // }

        return view('pages.pos-customer-view-order-list')->with('holdorder', $holdOrderList);

    }

    function CustomerOrderDetail(Request $request) {
        $category_list=[];
        $menuList=[];

        $client = new GuestServiceClient(config('moneta.guest.address'), [
            'credentials' => \Grpc\ChannelCredentials::createInsecure(), 
        ]);

        $grpcRequest = new GuestMenuRequest();
        $grpcRequest->setSessionid(session()->get('session'));
        $grpcRequest->setQrcode(session()->get('qrcode'));
        list($grpcResults, $status) = $client->DoGuestMenu($grpcRequest, ['xid' => ['Moneta v.0.0.1']])->wait();
        $grpcHitStatus = $status->code;
        if ($grpcHitStatus === 0) {
            if ($grpcResults->getStatus() === '000') {
                $request->session()->put('session', $grpcResults->getSession());
                foreach($grpcResults->getResults() as $index) {
                    array_push($menuList, $index);
                    array_push($category_list, $index->getCategoryname());
                }
            } else {
                Log::debug('gagal get all menu '. $grpcResults->getStatus());
                return redirect()->back()->withErrors('Error menu with status' . $grpcResults->getStatus());
            }
        } else {
            Log::debug('gagal hit all menu');
            return redirect()->back()->withErrors('Error hit all menu with status' . $grpcHitStatus);
        }

        $client = new GuestServiceClient(config('moneta.guest.address'), [
            'credentials' => \Grpc\ChannelCredentials::createInsecure(), 
        ]);

        $grpcRequest = new GuestViewOrderRequest();
        $grpcRequest->setSessionid(session()->get('session'));
        $grpcRequest->setQrcode(session()->get('qrcode'));

        list($grpcResults, $status) = $client->DoGuestViewOrder($grpcRequest, ['xid' => ['Moneta v.0.0.1']])->wait();
        $grpcHitStatus = $status->code;
        if ($grpcHitStatus === 0) {
            if ($grpcResults->getStatus() === '000') {
                $request->session()->put('session', $grpcResults->getSession());
                $category_list = array_unique($category_list);
                return view('pages.pos-customer-order')->with('result', $grpcResults)->with('categories', $category_list)->with('menus', $menuList);
            } else {
                Log::debug('gagal get hold order detail '. $grpcResults->getStatus());
                return redirect()->back()->withErrors('Error hold order detail with status' . $grpcResults->getStatus());
            }
        } else {
            Log::debug('gagal hit');
            return redirect()->back()->withErrors('Error hit hold order detail with status' . $grpcHitStatus);
        }
    }

    function SeeOrderDetail(Request $request) {
        Log::debug('CustomerOrderDetail');

        $client = new PosServiceClient(config('moneta.pos.address'), [
            'credentials' => \Grpc\ChannelCredentials::createInsecure(), 
        ]);
        $categoryId = [];
        $categoryName = [];
        $menuList = [];

        $grpcRequest = new GetCategoryRequest();
        $grpcRequest->setPosid(session()->get('sessPosID'));
        $grpcRequest->setStoreid(session()->get('sessStoreID'));
        $grpcRequest->setSession(session()->get('session'));

        list($grpcResults, $status) = $client->DoGetCategory($grpcRequest, ['xid' => ['Moneta v.0.0.1']])->wait();
        $grpcHitStatus = $status->code;
        if ($grpcHitStatus === 0) {
            if ($grpcResults->getStatus() === '000') {
                $request->session()->put('session', $grpcResults->getSession());
                foreach($grpcResults->getResults() as $index) {
                    array_push($categoryId, $index->getCategoryid());
                    array_push($categoryName, $index->getName());
                }
                foreach($categoryId as $requestId) {
                    $grpcRequest = new GetMenuRequest();
                    $grpcRequest->setCategoryid($requestId);
                    $grpcRequest->setPosid(session()->get('sessPosID'));
                    $grpcRequest->setStoreid(session()->get('sessStoreID'));
                    $grpcRequest->setSession(session()->get('session'));
                    list($grpcResults, $status) = $client->DoGetMenu($grpcRequest, ['xid' => ['Moneta v.0.0.1']])->wait();

                    if ($grpcHitStatus === 0) {
                        if ($grpcResults->getStatus() === '000') {
                            $request->session()->put('session', $grpcResults->getSession());
                            foreach($grpcResults->getResults() as $index) {
                                array_push($menuList, $index);
                            }
                        } else {
                            Log::debug('gagal get menu '. $grpcResults->getStatus());
                            return redirect()->back()->withErrors('Error menu with status' . $grpcResults->getStatus());
                        }
                    } else {
                        Log::debug('gagal hit menu');
                        return redirect()->back()->withErrors('Error hit menu with status' . $grpcResults->getStatus());
                    }
                }
            } else {
                Log::debug('gagal get category '. $grpcResults->getStatus());
                return redirect()->back()->withErrors('Error category with status' . $grpcResults->getStatus());
            }
        } else {
            Log::debug('gagal hit');
            return redirect()->back()->withErrors('Error hit category with status' . $grpcResults->getStatus());
        }
    }

    function MenuStock(Request $request) {
        Log::debug('MenuStock');
        $client = new PosServiceClient(config('moneta.pos.address'), [
            'credentials' => \Grpc\ChannelCredentials::createInsecure(), 
        ]);
        $categoryId = [];
        $categoryName = [];
        $menuList = [];
        $catId = [];

        $grpcRequest = new GetCategoryRequest();
        $grpcRequest->setPosid(session()->get('sessPosID'));
        $grpcRequest->setStoreid(session()->get('sessStoreID'));
        $grpcRequest->setSession(session()->get('session'));

        list($grpcResults, $status) = $client->DoGetCategory($grpcRequest, ['xid' => ['Moneta v.0.0.1']])->wait();
        $grpcHitStatus = $status->code;
        if ($grpcHitStatus === 0) {
            if ($grpcResults->getStatus() === '000') {
                $request->session()->put('session', $grpcResults->getSession());
                foreach($grpcResults->getResults() as $index) {
                    array_push($categoryId, $index->getCategoryid());
                    array_push($categoryName, $index->getName());
                }
                foreach($categoryId as $requestId) {
                    $grpcRequest = new GetMenuRequest();
                    $grpcRequest->setCategoryid($requestId);
                    $grpcRequest->setPosid(session()->get('sessPosID'));
                    $grpcRequest->setStoreid(session()->get('sessStoreID'));
                    $grpcRequest->setSession(session()->get('session'));
                    list($grpcResults, $status) = $client->DoGetMenu($grpcRequest, ['xid' => ['Moneta v.0.0.1']])->wait();

                    if ($grpcHitStatus === 0) {
                        if ($grpcResults->getStatus() === '000') {
                            $request->session()->put('session', $grpcResults->getSession());
                            foreach($grpcResults->getResults() as $index) {
                                array_push($catId, $requestId);
                                array_push($menuList, $index);
                            }
                        } else {
                            Log::debug('gagal get menu '. $grpcResults->getStatus());
                            return redirect()->back()->withErrors('Error menu with status' . $grpcResults->getStatus());
                        }
                    } else {
                        Log::debug('gagal hit menu');
                        return redirect()->back()->withErrors('Error hit menu with status' . $grpcResults->getStatus());
                    }
                }
                return view('pages.pos-menu-stock')->with('menulist', $menuList)->with('catid', $catId);
            } else {
                Log::debug('gagal get category '. $grpcResults->getStatus());
                return redirect()->back()->withErrors('Error category with status' . $grpcResults->getStatus());
            }
        } else {
            Log::debug('gagal hit');
            return redirect()->back()->withErrors('Error hit category with status' . $grpcHitStatus);
        }

    }
    
    function DoUpdateMenu(Request $request) {
        Log::debug('DoUpdateMenu'); 

        // return redirect('/pos/menu-stock')->withErrors('tes aja');
        
        $isstocksame = strcmp($request->input('oldstock'), $request->input('stock'));
        $isactivationsame = strcmp($request->input('oldactivate'), $request->input('activate'));

        $client = new PosServiceClient(config('moneta.pos.address'), [
            'credentials' => \Grpc\ChannelCredentials::createInsecure(), 
        ]);
        if ($isactivationsame != 0) {
            Log::debug('activation is not same');
            $grpcRequest = new ToggleMenuRequest();
            $togglearray = [];
            $toggleData = new ToggleMenuData();
            $toggleData->setCategoryid($request->input('category-id'));
            $toggleData->setMenuid($request->input('menu-id'));
            array_push($togglearray, $toggleData);

            $grpcRequest->setPosid(session()->get('sessPosID'));
            $grpcRequest->setStoreid(session()->get('sessStoreID'));
            $grpcRequest->setSession(session()->get('session'));
            $grpcRequest->setData($togglearray);

            list($grpcResults, $status) = $client->DoToggleMenu($grpcRequest, ['xid' => ['Moneta v.0.0.1']])->wait();
            $grpcHitStatus = $status->code;
            if ($grpcHitStatus === 0) {
                if ($grpcResults->getStatus() !== '000') {
                    return redirect()->back()->withErrors('unable to do Toggle Menu, error code: ' . $grpcResults->getStatus());
                }
            } else {
                return redirect()->back()->withErrors('unable to hit endpoint Toggle Menu, error code: ' . $grpcHitStatus);
            }
        }

        if ($isstocksame != 0) {
            Log::debug('stock is not same');
            $grpcRequest = new UpdateStockRequest();
            $grpcRequest->setPosid(session()->get('sessPosID'));
            $grpcRequest->setStoreid(session()->get('sessStoreID'));
            $grpcRequest->setSession(session()->get('session'));

            $stockarray = [];
            $stockData = new UpdateStockData();
            $stockData->setMenuid($request->input('menu-id'));
            $stockData->setAmount($request->input('stock'));
            array_push($stockarray, $stockData);

            $grpcRequest->setData($stockarray);

            list($grpcResults, $status) = $client->DoUpdateStock($grpcRequest, ['xid' => ['Moneta v.0.0.1']])->wait();
            $grpcHitStatus = $status->code;
            if ($grpcHitStatus === 0) {
                if ($grpcResults->getStatus() !== '000') {
                    return redirect()->back()->withErrors('unable to do Update Stock, error code: ' . $grpcResults->getStatus());
                }
            } else {
                return redirect()->back()->withErrors('unable to hit endpoint Update Stock, error code: ' . $grpcHitStatus);
            }
        }

        return redirect('/pos/menu-stock');
    }

    function NewOrderForm(Request $request) {
        Log::debug('NewOrderForm'); 

        $client = new PosServiceClient(config('moneta.pos.address'), [
            'credentials' => \Grpc\ChannelCredentials::createInsecure(), 
        ]);
        
        $existingCustomer = [];

        $grpcRequest = new ViewCustomerRequest();
        $grpcRequest->setPosid(session()->get('sessPosID'));
        $grpcRequest->setStoreid(session()->get('sessStoreID'));
        $grpcRequest->setSession(session()->get('session'));

        list($grpcResults, $status) = $client->DoViewCustomer($grpcRequest, ['xid' => ['Moneta v.0.0.1']])->wait();
        $grpcHitStatus = $status->code;
        if ($grpcHitStatus === 0) {
            if ($grpcResults->getStatus() === '000') {
                $request->session()->put('session', $grpcResults->getSession());
                foreach ($grpcResults->getResults() as $result) {
                    array_push($existingCustomer, $result);
                }
                return view('pages.pos-new-order')->with('existing', $existingCustomer);
            }
        } else {
            return redirect()->back()->withErrors('unable to hit endpoint View Customer, error code: ' . $grpcHitStatus);
        }
    }

    function DoNewOrder(Request $request) {
        if ($request->input('check_create_switch') == "off") {
            $client = new TrxServiceClient(config('moneta.pos.address'), [
                'credentials' => \Grpc\ChannelCredentials::createInsecure(), 
            ]);
            $grpcRequest = new NewOrderRequest();
            $grpcRequest->setPosid(session()->get('sessPosID'));
            $grpcRequest->setStoreid(session()->get('sessStoreID'));
            $grpcRequest->setSession(session()->get('session'));
            $grpcRequest->setCustomerid($request->input('existing_customer'));

            list($grpcResults, $status) = $client->DoNewOrder($grpcRequest, ['xid' => ['Moneta v.0.0.1']])->wait();
            $grpcHitStatus = $status->code;
            if ($grpcHitStatus === 0) {
                if ($grpcResults->getStatus() === '000') {
                    $request->session()->put('session', $grpcResults->getSession());
                    $orderid = $grpcResults->getResults()[0]->getOrderid();
                    return redirect('/pos/customer-order/'.$orderid);
                }
            } else {
                return redirect()->back()->withErrors('unable to hit endpoint Make New Order, error code: ' . $grpcHitStatus);
            }
        } else {

            $client = new PosServiceClient(config('moneta.pos.address'), [
                'credentials' => \Grpc\ChannelCredentials::createInsecure(), 
            ]);

            $grpcRequest = new AddCustomerRequest();
            $grpcRequest->setPosid(session()->get('sessPosID'));
            $grpcRequest->setStoreid(session()->get('sessStoreID'));
            $grpcRequest->setSession(session()->get('session'));
            $grpcRequest->setName($request->input('name'));
            $grpcRequest->setPhone($request->input('phone'));
            $grpcRequest->setEmail($request->input('email'));
            $grpcRequest->setGender($request->input('gender'));
            $grpcRequest->setAddress($request->input('address'));
            $grpcRequest->setRegion($request->input('region'));
            $grpcRequest->setCountry($request->input('country'));
            $grpcRequest->setZipcode($request->input('zipcode'));
            $grpcRequest->setIdtype($request->input('idtype'));
            $grpcRequest->setIdnumber($request->input('idnumber'));

            list($grpcResults, $status) = $client->DoAddCustomer($grpcRequest, ['xid' => ['Moneta v.0.0.1']])->wait();
            $grpcHitStatus = $status->code;
            if ($grpcHitStatus === 0) {
                if ($grpcResults->getStatus() === '000') {
                    $request->session()->put('session', $grpcResults->getSession());
                    $customerid = $grpcResults->getResults()[0]->getCustomerid();
                    
                    $client = new TrxServiceClient(config('moneta.pos.address'), [
                        'credentials' => \Grpc\ChannelCredentials::createInsecure(), 
                    ]);
                    $grpcRequest = new NewOrderRequest();
                    $grpcRequest->setPosid(session()->get('sessPosID'));
                    $grpcRequest->setStoreid(session()->get('sessStoreID'));
                    $grpcRequest->setSession(session()->get('session'));
                    $grpcRequest->setCustomerid($customerid);
        
                    list($grpcResults, $status) = $client->DoNewOrder($grpcRequest, ['xid' => ['Moneta v.0.0.1']])->wait();
                    $grpcHitStatus = $status->code;
                    if ($grpcHitStatus === 0) {
                        if ($grpcResults->getStatus() === '000') {
                            $request->session()->put('session', $grpcResults->getSession());
                            $orderid = $grpcResults->getResults()[0]->getOrderid();
                            return redirect('/pos/customer-order/'.$orderid);
                        } else {
                            return redirect()->back()->withErrors('error callback from endpoint Make New Order, error code: ' . $$grpcResults->getStatus());
                        }
                    } else {
                        return redirect()->back()->withErrors('unable to hit endpoint Make New Order, error code: ' . $grpcHitStatus);
                    }

                } else {
                    return redirect()->back()->withErrors('error callback from endpoint Make New Customer, error code: ' . $$grpcResults->getStatus());
                }
            } else {
                return redirect()->back()->withErrors('unable to hit endpoint Make New Customer, error code: ' . $grpcHitStatus);
            }
        }
    }

    function DoOrder(Request $request) {
        error_log($request->getContent());
        error_log("MASUK KE DO ORDER");
        if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') != 0){
            error_log("ERROR REQUEST METHOD");
            //If it isn't, send back a 405 Method Not Allowed header.
            header($_SERVER["SERVER_PROTOCOL"]." 405 Method Not Allowed", true, 405);
            exit;
        }

        $newArray = explode("&", $request->getContent());
        $payloadArray = [];
        foreach ($newArray as $theString) {
            array_push($payloadArray, explode("=", $theString));
        }

        $menu_id = $payloadArray[0][1];
        $qty = $payloadArray[1][1];
        $addon = $payloadArray[2][1];
        $addonArray = explode(',', $addon);

        $client = new GuestServiceClient(config('moneta.guest.address'), [
                'credentials' => \Grpc\ChannelCredentials::createInsecure(), 
        ]);
        $grpcRequest = new GuestAddOrderRequest();
        $grpcRequest->setSessionid(session()->get('session'));
        $grpcRequest->setQrcode(session()->get('qrcode'));
        $grpcRequest->setAmount(floatval($qty));
        $grpcRequest->setType("");
        $grpcRequest->setMenuid($menu_id);
        $addonList = [];
        if ($addonArray[0] != "") {
            foreach ($addonArray as $theAddon) {
                $addonRequest = new GuestAddOrderAddon();
                $addonRequest->setAddonid($theAddon);
                array_push($addonList, $addonRequest);
            }
        }
        $grpcRequest->setAddon($addonList);

        print_r($grpcRequest->serializeToJsonString());
        list($grpcResults, $status) = $client->DoGuestAddOrder($grpcRequest, ['xid' => ['Moneta v.0.0.1']])->wait();
        $grpcHitStatus = $status->code;
        if ($grpcHitStatus === 0) {
            if ($grpcResults->getStatus() === '000') {
                $request->session()->put('session', $grpcResults->getSession());
                http_response_code(200);
            } else {
                $request->session()->put('session', $grpcResults->getSession());
                http_response_code(500);
                error_log($grpcResults->getStatus());
            }
        } else {
            http_response_code(500);
            error_log($grpcHitStatus);
        }

    }

    function DoAdjusmentOrder(Request $request) {
        error_log($request->getContent());
        error_log("MASUK KE DO ORDER");
        if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') != 0){
            error_log("ERROR REQUEST METHOD");
            //If it isn't, send back a 405 Method Not Allowed header.
            header($_SERVER["SERVER_PROTOCOL"]." 405 Method Not Allowed", true, 405);
            exit;
        }

        $newArray = explode("&", $request->getContent());
        $payloadArray = [];
        foreach ($newArray as $theString) {
            array_push($payloadArray, explode("=", $theString));
        }

        $client = new TrxServiceClient(config('moneta.pos.address'), [
            'credentials' => \Grpc\ChannelCredentials::createInsecure(), 
        ]);

        $grpcRequest = new AdjustmentOrderRequest();
        $grpcRequest->setPosid(session()->get('sessPosID'));
        $grpcRequest->setStoreid(session()->get('sessStoreID'));
        $grpcRequest->setSession(session()->get('session'));
        $grpcRequest->setMenuid($payloadArray[0][1]);
        $grpcRequest->setOrderid($payloadArray[1][1]);
        $grpcRequest->setValue($payloadArray[2][1]);
        $grpcRequest->setAdminpin('115100defaultEncryption');

        list($grpcResults, $status) = $client->DoAdjustmentOrder($grpcRequest, ['xid' => ['Moneta v.0.0.1']])->wait();
        $grpcHitStatus = $status->code;
        if ($grpcHitStatus === 0) {
            if ($grpcResults->getStatus() === '000') {
                http_response_code(200);
            } else {
                http_response_code(500);
                error_log($grpcResults->getStatus());
            }
        } else {
            http_response_code(500);
            error_log($grpcHitStatus);
        }
    }
}

