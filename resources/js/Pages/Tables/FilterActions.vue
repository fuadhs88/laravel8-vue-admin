<template>
    <div class="btn-group mr-2">
<!--        <button type="button" class="btn btn-sm btn-default {{ $btn_class }}">-->
<!--            <input type="checkbox" class="d-none"><i class="fa fa-filter"></i><span class="hidden-xs">&nbsp;&nbsp;{{ admin_trans('admin.filter') }}</span>-->
<!--        </button>-->

<!--        @if($scopes->isNotEmpty())-->
<!--        <div class="btn-group">-->
<!--            <button type="button" class="btn btn-sm btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">-->
<!--                <span>{{ $label }}</span>-->
<!--                <span class="caret"></span>-->
<!--                <span class="sr-only">Toggle Dropdown</span>-->
<!--            </button>-->
<!--            <div class="dropdown-menu">-->
<!--                @foreach($scopes as $scope)-->
<!--                {!! $scope->render() !!}-->
<!--                @endforeach-->
<!--                <div class="dropdown-divider"></div>-->
<!--                <a href="{{ $cancel }}" class="dropdown-item">{{ admin_trans('admin.cancel') }}</a>-->
<!--            </div>-->
<!--        </div>-->
<!--        @endif-->
    </div>
</template>

<script>
    export default {
        name: "FilterActions"
    }
</script>

<style scoped>

</style>
