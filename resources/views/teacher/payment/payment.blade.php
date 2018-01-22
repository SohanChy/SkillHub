@extends('teacher.layouts.base')

@section('content')
<div id="content-wrapper">
  <div class="mui--appbar-height"></div>
  <div class="mui-container-fluid">

    <div class="mui-panel">

      <table class="mui-table">
        <thead>
          <tr>
            <th>Course/live stream name</th>
            <th>Student</th>
            <th>Amount</th>
          </tr>
        </thead>
        <tbody>
          @php
          $total = 0;
          @endphp
          @foreach(@$payments as $payment)
          <tr>
            <td>{{@$payment->course->title}}</td>
            <td>{{@$payment->student->name}}</td>
            <td>{{@$payment->course->price * .9}}</td>
          </tr>

          @php
          $total += $payment->course->price * .9;
          @endphp

          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <td></td>
            <td>Total:</td>
            <td>{{$total}}</td>
          </tr>
        </tfoot>
        <form action="{{ URL::to('/teacher/payments') }}" method="post" accept-charset="utf-8">
          {{ csrf_field() }}
          <button class="mui-btn mui-btn--primary pull-right" type="submit">Withdraw</button>        
        </form>

      </table>

      
    </div>
  </div>
</div>
</div>
@endsection