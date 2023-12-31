@if (!isset($row->fees_account->account_id))
    <div class="mb-1">
        <button data-modal-toggle="createFeesAccount"
            onclick="$('#createFeesAccount').find('input[name=symbol]').val('{{ $row->symbol }}');
        $('#createFeesAccount').find('input[name=postfix]').val('{{ $row->postfix }}');"
            class="btn btn-outline-warning btn-sm">
            <i class="bi bi-gear mr-2"></i> {{ __('Create Fees Account') }}
        </button>
    </div>
@endif

<div class="mb-1">
    <button data-modal-toggle="editWithdraw"
        onclick="openEditWithdrawModal({{ $row->id }}, {{ $row->withdraw_min ?? 0 }}, {{ $row->withdraw_max ?? 0 }}, {{ $row->withdraw_fee ?? 0 }})"
        class="btn btn-outline-success btn-sm">
        <i class="bi bi-gear mr-2"></i> {{ __('Withdraw Settings') }}
    </button>
</div>


<div class="mb-1">
    @if (!file_exists('assets/images/cryptoCurrency/' . strtolower($row->symbol) . '.png'))
        <button data-modal-toggle="addIcon"
            onclick="
        $('#addIcon').find('input[name=symbol]').val('{{ $row->symbol }}');"
            class="btn btn-outline-info btn-sm">
            <i class="bi bi-upload mr-2"></i> {{ __('Add Icon') }}
        </button>
    @else
        <button data-modal-toggle="addIcon"
            onclick="
        $('#addIcon').find('input[name=symbol]').val('{{ $row->symbol }}');"
            class="btn btn-outline-info btn-sm">
            <i class="bi bi-upload mr-2"></i> {{ __('Edit Icon') }}
        </button>
    @endif
</div>
@if (in_array($row->chain, ['ETH', 'CELO', 'BSC', 'ONE', 'KLAY', 'MATIC', 'TRON', 'SOL']))
    <div class="mb-1">
        <a href="{{ route('admin.eco.blockchain.addresses.index', [$row->chain, $row->symbol . $row->postfix]) }}"
            class="btn btn-outline-primary btn-sm">
            {{ __('Addresses') }}
        </a>
    </div>
@endif

<div>
    <a href="{{ route('admin.eco.blockchain.withdrawal.index', [$row->chain, $row->symbol . $row->postfix]) }}"
        class="btn btn-outline-danger btn-sm">
        {{ __('Withdrawals') }}
    </a>
</div>
