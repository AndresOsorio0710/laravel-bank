<div class="row-10">
  <div class="col"></div>
  <div class="col-8 box-shadow-1 p-1r m-1r"> 
    <h2 class="title text-center">My Transaction History</h2>
    <div class="container-center">
      <div class="form-control">
        <label for="">Source Account</label>
        <select name="" id="source_id" onchange="changeSourceId()">
          <option value="0" selected>All</option>
          @foreach ($my_accounts as $account)
            <option value="{{ $account->id }}">{{ strtoupper($account->name) }}</option>
          @endforeach
          @foreach ($other_accounts as $account)
            <option value="{{ $account->id }}">{{ strtoupper($account->name) }}</option>
          @endforeach
        </select>
      </div><div class="form-control">
        <label for="">Target Account</label>
        <select name="" id="target_id" onchange="changeTargetId()">
          <option value="0" selected>All</option>
          @foreach ($my_accounts as $account)
            <option value="{{ $account->id }}">{{ strtoupper($account->name) }}</option>
          @endforeach
          @foreach ($other_accounts as $account)
            <option value="{{ $account->id }}">{{ strtoupper($account->name) }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <table>
      <thead>
        <tr>
          <th class="text-left">Date</th>
          <th class="text-left">Source Account</th>
          <th class="text-left">Target Account</th>
          <th class="text-right">Amount</th>
        </tr>
      </thead> 
      <tbody id="table">
      </tbody>
    </table> 
    <div id="paginator" class="container-center mtop-16">
      <a id="back" class="btn m-1r" onclick="backPage()">Back</a>
      <small id="page"  class="m-1r"></small>
      <a id="next" class="btn m-1r" onclick="nextPage()">Next</a>
    </div>
  </div>
  <div class="col"></div>
</div> 

@section('js')
<script>
  const d = document;
  const transactions = {!! json_encode($transactions) !!};
  const user_id = {!! Auth::user()->id !!}
  const table = d.querySelector('#table');
  const paginator = d.querySelector('#paginator');
  const back = d.querySelector('#back');
  const next = d.querySelector('#next');
  const lblPage = d.querySelector('#page');
  const source_account = d.querySelector('#source_id');
  const target_account = d.querySelector('#target_id');

  d.addEventListener("DOMContentLoaded", e=>loadTable());

  let page = 1;
  let rows = transactions.length;
  let init=0;
  let numberGroup = 5;
  let limit = numberGroup;
  let transactionsResult = [];
  let source_id=0;
  let target_id=0;

  const formatterPeso = new Intl.NumberFormat('es-CO', {
    style: 'currency',
    currency: 'COP',
    minimumFractionDigits: 2
  })

  function filterTransactions(){
    if(source_id==target_id){
      console.log('Son iguales ',source_id,target_id);
      transactionsResult = transactions;
    }else{
      if(source_id!=0 && target_id!=0){
        console.log('Son != 0 ',source_id,target_id);
        transactionsResult = transactions.filter(t=>(t.source_account_id == source_id && t.target_account_id == target_id));
      }else{
        if(source_id!=0){
          console.log('Source != 0 ',source_id,target_id);
          transactionsResult = transactions.filter(t=>(t.source_account_id == source_id));
        }else{
          console.log('Target != 0 ',source_id,target_id);
          transactionsResult = transactions.filter(t=>(t.target_account_id == target_id));
        }
      }
    }
    console.log(transactionsResult);
  }

  function loadTable(){
    console.log('Rows % NuG:',rows % numberGroup,' Init:',init,' Limit:',limit,'Page:',page,' Rows:',rows);
    filterTransactions();
    table.innerHTML = '';
    for(let transaction of transactionsResult.slice(init,limit)){
      date = new Date(transaction.created_at);
      amount = parseFloat(transaction.amount);
      tdAmount = '';
      if (transaction.source_id != user_id){
        tdAmount = `<td class="text-right text-success">${formatterPeso.format(amount)}</td>`;
      }else{
        if(transaction.source_id == transaction.target_id){
          tdAmount = `<td class="text-right">${formatterPeso.format(amount)}</td>`;
        }else{
          tdAmount = `<td class="text-right text-danger">${formatterPeso.format(amount)}</td>`;
        }
      }
      table.innerHTML +=`
        <tr>
          <td>${date.toLocaleString()}</td>
          <td>${transaction.source_account.toUpperCase()}</td>
          <td>${transaction.target_account.toUpperCase()}</td>
          ${tdAmount}        
        </tr>
      `
    }
    getRaginator();
  }

  function getRaginator(){
    rows = transactionsResult.length
    if(page==1){
      back.classList.add("none");
    }else{
      back.classList.remove("none");
    }
    if(rows<=numberGroup){
      next.classList.add("none");
    }
    if(limit<=(rows-(rows%numberGroup))){
      next.classList.remove("none");
    }
    lblPage.innerHTML = '';
    lblPage.innerHTML = `Pag. ${page}`;
  }

  function nextPage(){
    init+=numberGroup;
    limit+=numberGroup;
    page+=1;
    if(limit>=rows){
      next.classList.add("none");
    }
    loadTable()
  }

  function backPage(){
    init-=numberGroup;
    limit-=numberGroup;
    page-=1;
    if(init<numberGroup){
      init=0;
    }
    loadTable()
  }

  function changeSourceId(){
    source_id = source_account.options[source_account.selectedIndex].value;
    loadTable();
  }

function changeTargetId(){
  target_id=target_account.options[target_account.selectedIndex].value;
    loadTable();
}
</script>
@endsection