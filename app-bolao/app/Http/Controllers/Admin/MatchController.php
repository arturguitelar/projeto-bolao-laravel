<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\MatchRepositoryInterface;
use Validator;

class MatchController extends Controller
{    
    private $route = 'matches';
    private $paginate = 10;
    private $search = ['title', 'stadium', 'team_a', 'team_b'];
    private $model;
    
    public function __construct(MatchRepositoryInterface $model)
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
        $columnList = [
            'id'=>'#',
            'title'=>trans('bolao.title'),
            'stadium'=>trans('bolao.stadium'),
            'team_a'=>trans('bolao.team_a'),
            'team_b'=>trans('bolao.team_b'),
            'result'=>trans('bolao.result'),
            'scoreboard_a'=>trans('bolao.scoreboard_a'),
            'scoreboard_b'=>trans('bolao.scoreboard_b'),
            'date_br'=>trans('bolao.date')
        ];

        $page = trans('bolao.match_list');
        
        $search = "";
        if(isset($request->search)){
            $search = $request->search;
            $list = $this->model->findWhereLike($this->search,$search,'id','DESC');
        }else{
            $list = $this->model->paginate($this->paginate,'id','DESC');
        }
        
        $routeName = $this->route;
        
        $breadcrumb = [
            (object)['url'=>route('home'), 'title'=>trans('bolao.home')],
            (object)['url'=>'', 'title'=>trans('bolao.list', ['page'=>$page])],
        ];
        
        return view('admin.'.$routeName.'.index',compact(
            'list', 'search', 'page', 'routeName', 'columnList', 'breadcrumb'
        ));
    }
    
    /**
    * Mostra um formulário para criar um novo recurso.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $routeName = $this->route;
        $page = trans('bolao.match_list');
        $page_create = trans('bolao.match');
        
        $user = auth()->user();
        $listRel = $user->rounds;

        $breadcrumb = [
            (object)['url'=>route('home'),'title'=>trans('bolao.home')],
            (object)['url'=>route($routeName.".index"),'title'=>trans('bolao.list',['page'=>$page])],
            (object)['url'=>'','title'=>trans('bolao.create_crud',['page'=>$page_create])],
        ];
        
        return view('admin.'.$routeName.'.create', compact(
            'page', 'page_create', 'routeName', 'breadcrumb', 'listRel' 
        ));
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
                'title' => 'required|string|max:255',
                'stadium' => 'required',
                'team_a' => 'required',
                'team_b' => 'required',
                'result' => 'required',
                'scoreboard_a' => 'required',
                'scoreboard_b' => 'required',
                'date' => 'required',
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
            $page = trans('bolao.match_list');
            $page2 = trans('bolao.match');
            
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
            $page = trans('bolao.match_list');
            $page2 = trans('bolao.match');

            $user = auth()->user();
            $listRel = $user->rounds;
            $register_id = $register->round_id;
            
            $breadcrumb = [
                (object)['url'=>route('home'),'title'=>trans('bolao.home')],
                (object)['url'=>route($routeName.".index"),'title'=>trans('bolao.list',['page'=>$page])],
                (object)['url'=>'','title'=>trans('bolao.edit_crud',['page'=>$page2])],
            ];
            
            return view('admin.'.$routeName.'.edit', compact(
                'register', 'page', 'page2', 'routeName', 'breadcrumb', 'listRel', 'register_id'
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

        Validator::make($data, [
            'title' => 'required|string|max:255',
            'stadium' => 'required',
            'team_a' => 'required',
            'team_b' => 'required',
            'result' => 'required',
            'scoreboard_a' => 'required',
            'scoreboard_b' => 'required',
            'date' => 'required',
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
