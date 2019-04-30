<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\UserRepositoryInterface;
use Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{    
    private $route = 'users';
    private $paginate = 5;
    private $search = ['name','email'];
    private $model;
    
    public function __construct(UserRepositoryInterface $model)
    {       
        $this->model = $model;   
    }
    
    /**
    * Listagem de recurso do storage.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $columnList = ['id'=>'#','name'=>trans('bolao.name'),'email'=>trans('bolao.email')];
        $page = trans('bolao.user_list');
        
        $search = "";
        if(isset($request->search)){
            $search = $request->search;
            $list = $this->model->findWhereLike($this->search,$search,'id','DESC');
        }else{
            $list = $this->model->paginate($this->paginate,'id','DESC');
        }
        
        $routeName = $this->route;
        
        $breadcrumb = [
            (object)['url'=>route('home'),'title'=>trans('bolao.home')],
            (object)['url'=>'','title'=>trans('bolao.list',['page'=>$page])],
        ];
        
        return view('admin.'.$routeName.'.index',compact('list','search','page','routeName','columnList','breadcrumb'));
    }
    
    /**
    * Mostra um formulário para criar um novo recurso.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $routeName = $this->route;
        $page = trans('bolao.user_list');
        $page_create = trans('bolao.user');
        
        $breadcrumb = [
            (object)['url'=>route('home'),'title'=>trans('bolao.home')],
            (object)['url'=>route($routeName.".index"),'title'=>trans('bolao.list',['page'=>$page])],
            (object)['url'=>'','title'=>trans('bolao.create_crud',['page'=>$page_create])],
        ];
        
        return view('admin.'.$routeName.'.create',compact('page','page_create','routeName','breadcrumb'));
    }
    
    /**
    * Grava um novo recurso no storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $data = $request->all();
        
        Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            ]
        )->validate();
            
        if($this->model->create($data)){
            $this->sessionMessage('record_added_successfully', 'success');
            return redirect()->back();
        } else {
            $this->sessionMessage('error_adding_registry', 'error');
            return redirect()->back();
        }
    }
    
    /**
    * Mostra um recurso especificado.
    *
    * @param  int  $id
    * @param  Request  $request
    * @return \Illuminate\Http\Response
    */
    public function show($id, Request $request)
    {
        $routeName = $this->route;
        $register = $this->model->find($id);
        
        if($register){
            $page = trans('bolao.user_list');
            $page2 = trans('bolao.user');
            
            $breadcrumb = [
                (object)['url'=>route('home'),'title'=>trans('bolao.home')],
                (object)['url'=>route($routeName.".index"),'title'=>trans('bolao.list',['page'=>$page])],
                (object)['url'=>'','title'=>trans('bolao.show_crud',['page'=>$page2])],
            ];

            /*
             * Verifica se o usuário está deletando o registro para poder mostrar
             * o botão de delete e a mensagem.
             */
            $delete = false;
            if ($request->delete ?? false) {
                $this->sessionMessage('delete_this_record', 'notification');
                $delete = true;
            }

            return view('admin.'.$routeName.'.show', compact(
                'register', 'page', 'page2', 'routeName', 'breadcrumb', 'delete'
            ));
            
        }
        
        return redirect()->route($routeName.'.index');
    }
    
    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $routeName = $this->route;
        $register = $this->model->find($id);
        
        if($register){
            $page = trans('bolao.user_list');
            $page2 = trans('bolao.user');
            
            $breadcrumb = [
                (object)['url'=>route('home'),'title'=>trans('bolao.home')],
                (object)['url'=>route($routeName.".index"),'title'=>trans('bolao.list',['page'=>$page])],
                (object)['url'=>'','title'=>trans('bolao.edit_crud',['page'=>$page2])],
            ];
            
            return view('admin.'.$routeName.'.edit', compact(
                'register','page','page2','routeName','breadcrumb'
            ));            
        }
        
        return redirect()->route($routeName.'.index');
    }
    
    /**
    * Atualiza um recurso especificado no storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        // Se o campo password está vazio, significa que o usuário não o modificou então não precisa ser enviado.
        if (! $data['password']) unset($data['password']);

        Validator::make($data, [
            'name' => 'required|string|max:255',
            /* É preciso utilizar o Rules por causa da regra de id único */
            'email' => ['required','string','email','max:255',Rule::unique('users')->ignore($id)],
            /* sometimes valida se o password existe no array para realizar a validação */
            'password' => 'sometimes|required|string|min:6|confirmed', 
            ]
        )->validate();

        if($this->model->update($data, $id)){
            $this->sessionMessage('record_edited_successfully', 'success');
            return redirect()->back();
        } else {
            $this->sessionMessage('error_editing_registry', 'error');
            return redirect()->back();
        }
    }
    
    /**
    * Remove o recurso especificado do storage.
    * - Redireciona a rota após a remoção.
    *
    * @param  int  $id
    * @return redirect
    */
    public function destroy($id)
    {
        if ($this->model->delete($id)) {
            $this->sessionMessage('registration_deleted_successfully', 'success');
        } else {
            $this->sessionMessage('error_deleting_record', 'error');
        }

        $routeName = $this->route;
        return redirect()->route($routeName.'.index');
    }

    /* Mensagens */
    /**
     * Envia uma mensagem especificada para a sessão atual.
     * 
     * @param string $msg Mensagem.
     * @param string $status Status da mensagem. Ex: success error notification.
     * 
     * Nota: para o status da mensagem está se utilizando classes css do bootstrap.
     */
    private function sessionMessage($msg, $status)
    {
        session()->flash('msg', trans('bolao.'.$msg));
        session()->flash('status', $status);
    }
}
