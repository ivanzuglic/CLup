@extends('layouts.base')

@section('title','managerView')

@section('main')

<div class="form widget widget-medium">
    <div class="widget-header title-only">
        <h2 class="widget-title">Opening dates and hours of the store</h2>
    </div>
    <form method="POST" class="form-inline">

        <div class="form-check">
            <input type="checkbox" class="form-check-label" id="Monday">
            <label class="form-check-label" for="Monday">Monday</label>

            <div class="form-group" style="padding-left:8px; padding-top:10px;">
                <select name="Hours" id="c1" class="form-control circle-select">
                    <option value=""> H </option>
                    <option value="D0">00</option>
                    <option value="D1">01</option>
                    <option value="D2">02</option>
                    <option value="D3">03</option>
                    <option value="D4">04</option>
                    <option value="D5">05</option>
                    <option value="D6">06</option>
                    <option value="D7">07</option>
                    <option value="D8">08</option>
                    <option value="D9">09</option>
                    <option value="D10">10</option>
                    <option value="D11">11</option>
                    <option value="D12">12</option>
                    <option value="D13">13</option>
                    <option value="D14">14</option>
                    <option value="D15">15</option>
                    <option value="D16">16</option>
                    <option value="D17">17</option>
                    <option value="D18">18</option>
                    <option value="D19">19</option>
                    <option value="D20">20</option>
                    <option value="D21">21</option>
                    <option value="D22">22</option>
                    <option value="D23">23</option>
                </select>
            </div>
            <span class="label label-default" style="padding-top: 10px;">:</span>
            <div class="form-group" style="padding-top: 10px;">
                <select name="Minutes" id="c2" class="form-control circle-select">
                    <option value=""> M </option>
                    <option value="D0">00</option>
                    <option value="D1">01</option>
                    <option value="D2">02</option>
                    <option value="D3">03</option>
                    <option value="D4">04</option>
                    <option value="D5">05</option>
                    <option value="D6">06</option>
                    <option value="D7">07</option>
                    <option value="D8">08</option>
                    <option value="D9">09</option>
                    <option value="D10">10</option>
                    <option value="D11">11</option>
                    <option value="D12">12</option>
                    <option value="D13">13</option>
                    <option value="D14">14</option>
                    <option value="D15">15</option>
                    <option value="D16">16</option>
                    <option value="D17">17</option>
                    <option value="D18">18</option>
                    <option value="D19">19</option>
                    <option value="D20">20</option>
                    <option value="D21">21</option>
                    <option value="D22">22</option>
                    <option value="D23">23</option>
                    <option value="D24">24</option>
                    <option value="D25">25</option>
                    <option value="D26">26</option>
                    <option value="D27">27</option>
                    <option value="D28">28</option>
                    <option value="D29">29</option>
                    <option value="D30">30</option>
                    <option value="D31">31</option>
                    <option value="D32">32</option>
                    <option value="D33">33</option>
                    <option value="D34">34</option>
                    <option value="D35">35</option>
                    <option value="D36">36</option>
                    <option value="D37">37</option>
                    <option value="D38">38</option>
                    <option value="D39">39</option>
                    <option value="D40">40</option>
                    <option value="D41">41</option>
                    <option value="D42">42</option>
                    <option value="D43">43</option>
                    <option value="D44">44</option>
                    <option value="D45">45</option>
                    <option value="D46">46</option>
                    <option value="D47">47</option>
                    <option value="D48">48</option>
                    <option value="D49">49</option>
                    <option value="D50">50</option>
                    <option value="D51">51</option>
                    <option value="D52">52</option>
                    <option value="D53">53</option>
                    <option value="D54">54</option>
                    <option value="D55">55</option>
                    <option value="D56">56</option>
                    <option value="D57">57</option>
                    <option value="D58">58</option>
                    <option value="D59">59</option>
                </select>
            </div>

            <span class="label label-default" style="padding-top: 10px;">--</span>


            <div class="form-group" style="padding-top: 10px;">
                <select name="Hours" id="c1" class="form-control circle-select">
                    <option value=""> H </option>
                    <option value="D0">00</option>
                    <option value="D1">01</option>
                    <option value="D2">02</option>
                    <option value="D3">03</option>
                    <option value="D4">04</option>
                    <option value="D5">05</option>
                    <option value="D6">06</option>
                    <option value="D7">07</option>
                    <option value="D8">08</option>
                    <option value="D9">09</option>
                    <option value="D10">10</option>
                    <option value="D11">11</option>
                    <option value="D12">12</option>
                    <option value="D13">13</option>
                    <option value="D14">14</option>
                    <option value="D15">15</option>
                    <option value="D16">16</option>
                    <option value="D17">17</option>
                    <option value="D18">18</option>
                    <option value="D19">19</option>
                    <option value="D20">20</option>
                    <option value="D21">21</option>
                    <option value="D22">22</option>
                    <option value="D23">23</option>
                </select>
            </div>
            <span class="label label-default" style="padding-top: 10px;">:</span>

            <div class="form-group" style="padding-top: 10px;">
                <select name="Minutes" id="c2" class="form-control circle-select">
                    <option value=""> M </option>
                    <option value="D0">00</option>
                    <option value="D1">01</option>
                    <option value="D2">02</option>
                    <option value="D3">03</option>
                    <option value="D4">04</option>
                    <option value="D5">05</option>
                    <option value="D6">06</option>
                    <option value="D7">07</option>
                    <option value="D8">08</option>
                    <option value="D9">09</option>
                    <option value="D10">10</option>
                    <option value="D11">11</option>
                    <option value="D12">12</option>
                    <option value="D13">13</option>
                    <option value="D14">14</option>
                    <option value="D15">15</option>
                    <option value="D16">16</option>
                    <option value="D17">17</option>
                    <option value="D18">18</option>
                    <option value="D19">19</option>
                    <option value="D20">20</option>
                    <option value="D21">21</option>
                    <option value="D22">22</option>
                    <option value="D23">23</option>
                    <option value="D24">24</option>
                    <option value="D25">25</option>
                    <option value="D26">26</option>
                    <option value="D27">27</option>
                    <option value="D28">28</option>
                    <option value="D29">29</option>
                    <option value="D30">30</option>
                    <option value="D31">31</option>
                    <option value="D32">32</option>
                    <option value="D33">33</option>
                    <option value="D34">34</option>
                    <option value="D35">35</option>
                    <option value="D36">36</option>
                    <option value="D37">37</option>
                    <option value="D38">38</option>
                    <option value="D39">39</option>
                    <option value="D40">40</option>
                    <option value="D41">41</option>
                    <option value="D42">42</option>
                    <option value="D43">43</option>
                    <option value="D44">44</option>
                    <option value="D45">45</option>
                    <option value="D46">46</option>
                    <option value="D47">47</option>
                    <option value="D48">48</option>
                    <option value="D49">49</option>
                    <option value="D50">50</option>
                    <option value="D51">51</option>
                    <option value="D52">52</option>
                    <option value="D53">53</option>
                    <option value="D54">54</option>
                    <option value="D55">55</option>
                    <option value="D56">56</option>
                    <option value="D57">57</option>
                    <option value="D58">58</option>
                    <option value="D59">59</option>
                </select>
            </div>
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-label" id="Tuesday">
            <label class="form-check-label" for="Tuesday">Tuesday</label>
            <div class="form-group" style="padding-left:8px; padding-top:10px;">
                <select name="Hours" id="c1" class="form-control circle-select">
                    <option value=""> H </option>
                    <option value="D0">00</option>
                    <option value="D1">01</option>
                    <option value="D2">02</option>
                    <option value="D3">03</option>
                    <option value="D4">04</option>
                    <option value="D5">05</option>
                    <option value="D6">06</option>
                    <option value="D7">07</option>
                    <option value="D8">08</option>
                    <option value="D9">09</option>
                    <option value="D10">10</option>
                    <option value="D11">11</option>
                    <option value="D12">12</option>
                    <option value="D13">13</option>
                    <option value="D14">14</option>
                    <option value="D15">15</option>
                    <option value="D16">16</option>
                    <option value="D17">17</option>
                    <option value="D18">18</option>
                    <option value="D19">19</option>
                    <option value="D20">20</option>
                    <option value="D21">21</option>
                    <option value="D22">22</option>
                    <option value="D23">23</option>
                </select>
            </div>
            <span class="label label-default" style="padding-top: 10px;">:</span>
            <div class="form-group" style="padding-top: 10px;">
                <select name="Minutes" id="c2" class="form-control circle-select">
                    <option value=""> M </option>
                    <option value="D0">00</option>
                    <option value="D1">01</option>
                    <option value="D2">02</option>
                    <option value="D3">03</option>
                    <option value="D4">04</option>
                    <option value="D5">05</option>
                    <option value="D6">06</option>
                    <option value="D7">07</option>
                    <option value="D8">08</option>
                    <option value="D9">09</option>
                    <option value="D10">10</option>
                    <option value="D11">11</option>
                    <option value="D12">12</option>
                    <option value="D13">13</option>
                    <option value="D14">14</option>
                    <option value="D15">15</option>
                    <option value="D16">16</option>
                    <option value="D17">17</option>
                    <option value="D18">18</option>
                    <option value="D19">19</option>
                    <option value="D20">20</option>
                    <option value="D21">21</option>
                    <option value="D22">22</option>
                    <option value="D23">23</option>
                    <option value="D24">24</option>
                    <option value="D25">25</option>
                    <option value="D26">26</option>
                    <option value="D27">27</option>
                    <option value="D28">28</option>
                    <option value="D29">29</option>
                    <option value="D30">30</option>
                    <option value="D31">31</option>
                    <option value="D32">32</option>
                    <option value="D33">33</option>
                    <option value="D34">34</option>
                    <option value="D35">35</option>
                    <option value="D36">36</option>
                    <option value="D37">37</option>
                    <option value="D38">38</option>
                    <option value="D39">39</option>
                    <option value="D40">40</option>
                    <option value="D41">41</option>
                    <option value="D42">42</option>
                    <option value="D43">43</option>
                    <option value="D44">44</option>
                    <option value="D45">45</option>
                    <option value="D46">46</option>
                    <option value="D47">47</option>
                    <option value="D48">48</option>
                    <option value="D49">49</option>
                    <option value="D50">50</option>
                    <option value="D51">51</option>
                    <option value="D52">52</option>
                    <option value="D53">53</option>
                    <option value="D54">54</option>
                    <option value="D55">55</option>
                    <option value="D56">56</option>
                    <option value="D57">57</option>
                    <option value="D58">58</option>
                    <option value="D59">59</option>
                </select>
            </div>

            <span class="label label-default" style="padding-top: 10px;">--</span>


            <div class="form-group" style="padding-top: 10px;">
                <select name="Hours" id="c1" class="form-control circle-select">
                    <option value=""> H </option>
                    <option value="D0">00</option>
                    <option value="D1">01</option>
                    <option value="D2">02</option>
                    <option value="D3">03</option>
                    <option value="D4">04</option>
                    <option value="D5">05</option>
                    <option value="D6">06</option>
                    <option value="D7">07</option>
                    <option value="D8">08</option>
                    <option value="D9">09</option>
                    <option value="D10">10</option>
                    <option value="D11">11</option>
                    <option value="D12">12</option>
                    <option value="D13">13</option>
                    <option value="D14">14</option>
                    <option value="D15">15</option>
                    <option value="D16">16</option>
                    <option value="D17">17</option>
                    <option value="D18">18</option>
                    <option value="D19">19</option>
                    <option value="D20">20</option>
                    <option value="D21">21</option>
                    <option value="D22">22</option>
                    <option value="D23">23</option>
                </select>
            </div>
            <span class="label label-default" style="padding-top: 10px;">:</span>

            <div class="form-group" style="padding-top: 10px;">
                <select name="Minutes" id="c2" class="form-control circle-select">
                    <option value=""> M </option>
                    <option value="D0">00</option>
                    <option value="D1">01</option>
                    <option value="D2">02</option>
                    <option value="D3">03</option>
                    <option value="D4">04</option>
                    <option value="D5">05</option>
                    <option value="D6">06</option>
                    <option value="D7">07</option>
                    <option value="D8">08</option>
                    <option value="D9">09</option>
                    <option value="D10">10</option>
                    <option value="D11">11</option>
                    <option value="D12">12</option>
                    <option value="D13">13</option>
                    <option value="D14">14</option>
                    <option value="D15">15</option>
                    <option value="D16">16</option>
                    <option value="D17">17</option>
                    <option value="D18">18</option>
                    <option value="D19">19</option>
                    <option value="D20">20</option>
                    <option value="D21">21</option>
                    <option value="D22">22</option>
                    <option value="D23">23</option>
                    <option value="D24">24</option>
                    <option value="D25">25</option>
                    <option value="D26">26</option>
                    <option value="D27">27</option>
                    <option value="D28">28</option>
                    <option value="D29">29</option>
                    <option value="D30">30</option>
                    <option value="D31">31</option>
                    <option value="D32">32</option>
                    <option value="D33">33</option>
                    <option value="D34">34</option>
                    <option value="D35">35</option>
                    <option value="D36">36</option>
                    <option value="D37">37</option>
                    <option value="D38">38</option>
                    <option value="D39">39</option>
                    <option value="D40">40</option>
                    <option value="D41">41</option>
                    <option value="D42">42</option>
                    <option value="D43">43</option>
                    <option value="D44">44</option>
                    <option value="D45">45</option>
                    <option value="D46">46</option>
                    <option value="D47">47</option>
                    <option value="D48">48</option>
                    <option value="D49">49</option>
                    <option value="D50">50</option>
                    <option value="D51">51</option>
                    <option value="D52">52</option>
                    <option value="D53">53</option>
                    <option value="D54">54</option>
                    <option value="D55">55</option>
                    <option value="D56">56</option>
                    <option value="D57">57</option>
                    <option value="D58">58</option>
                    <option value="D59">59</option>
                </select>
            </div>
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-label" id="Wednesday">
            <label class="form-check-label" for="Wednesday">Wednesday</label>
            <div class="form-group" style="padding-left:8px; padding-top:10px;">
                <select name="Hours" id="c1" class="form-control circle-select">
                    <option value=""> H </option>
                    <option value="D0">00</option>
                    <option value="D1">01</option>
                    <option value="D2">02</option>
                    <option value="D3">03</option>
                    <option value="D4">04</option>
                    <option value="D5">05</option>
                    <option value="D6">06</option>
                    <option value="D7">07</option>
                    <option value="D8">08</option>
                    <option value="D9">09</option>
                    <option value="D10">10</option>
                    <option value="D11">11</option>
                    <option value="D12">12</option>
                    <option value="D13">13</option>
                    <option value="D14">14</option>
                    <option value="D15">15</option>
                    <option value="D16">16</option>
                    <option value="D17">17</option>
                    <option value="D18">18</option>
                    <option value="D19">19</option>
                    <option value="D20">20</option>
                    <option value="D21">21</option>
                    <option value="D22">22</option>
                    <option value="D23">23</option>
                </select>
            </div>
            <span class="label label-default" style="padding-top: 10px;">:</span>
            <div class="form-group" style="padding-top: 10px;">
                <select name="Minutes" id="c2" class="form-control circle-select">
                    <option value=""> M </option>
                    <option value="D0">00</option>
                    <option value="D1">01</option>
                    <option value="D2">02</option>
                    <option value="D3">03</option>
                    <option value="D4">04</option>
                    <option value="D5">05</option>
                    <option value="D6">06</option>
                    <option value="D7">07</option>
                    <option value="D8">08</option>
                    <option value="D9">09</option>
                    <option value="D10">10</option>
                    <option value="D11">11</option>
                    <option value="D12">12</option>
                    <option value="D13">13</option>
                    <option value="D14">14</option>
                    <option value="D15">15</option>
                    <option value="D16">16</option>
                    <option value="D17">17</option>
                    <option value="D18">18</option>
                    <option value="D19">19</option>
                    <option value="D20">20</option>
                    <option value="D21">21</option>
                    <option value="D22">22</option>
                    <option value="D23">23</option>
                    <option value="D24">24</option>
                    <option value="D25">25</option>
                    <option value="D26">26</option>
                    <option value="D27">27</option>
                    <option value="D28">28</option>
                    <option value="D29">29</option>
                    <option value="D30">30</option>
                    <option value="D31">31</option>
                    <option value="D32">32</option>
                    <option value="D33">33</option>
                    <option value="D34">34</option>
                    <option value="D35">35</option>
                    <option value="D36">36</option>
                    <option value="D37">37</option>
                    <option value="D38">38</option>
                    <option value="D39">39</option>
                    <option value="D40">40</option>
                    <option value="D41">41</option>
                    <option value="D42">42</option>
                    <option value="D43">43</option>
                    <option value="D44">44</option>
                    <option value="D45">45</option>
                    <option value="D46">46</option>
                    <option value="D47">47</option>
                    <option value="D48">48</option>
                    <option value="D49">49</option>
                    <option value="D50">50</option>
                    <option value="D51">51</option>
                    <option value="D52">52</option>
                    <option value="D53">53</option>
                    <option value="D54">54</option>
                    <option value="D55">55</option>
                    <option value="D56">56</option>
                    <option value="D57">57</option>
                    <option value="D58">58</option>
                    <option value="D59">59</option>
                </select>
            </div>

            <span class="label label-default" style="padding-top: 10px;">--</span>


            <div class="form-group" style="padding-top: 10px;">
                <select name="Hours" id="c1" class="form-control circle-select">
                    <option value=""> H </option>
                    <option value="D0">00</option>
                    <option value="D1">01</option>
                    <option value="D2">02</option>
                    <option value="D3">03</option>
                    <option value="D4">04</option>
                    <option value="D5">05</option>
                    <option value="D6">06</option>
                    <option value="D7">07</option>
                    <option value="D8">08</option>
                    <option value="D9">09</option>
                    <option value="D10">10</option>
                    <option value="D11">11</option>
                    <option value="D12">12</option>
                    <option value="D13">13</option>
                    <option value="D14">14</option>
                    <option value="D15">15</option>
                    <option value="D16">16</option>
                    <option value="D17">17</option>
                    <option value="D18">18</option>
                    <option value="D19">19</option>
                    <option value="D20">20</option>
                    <option value="D21">21</option>
                    <option value="D22">22</option>
                    <option value="D23">23</option>
                </select>
            </div>
            <span class="label label-default" style="padding-top: 10px;">:</span>

            <div class="form-group" style="padding-top: 10px;">
                <select name="Minutes" id="c2" class="form-control circle-select">
                    <option value=""> M </option>
                    <option value="D0">00</option>
                    <option value="D1">01</option>
                    <option value="D2">02</option>
                    <option value="D3">03</option>
                    <option value="D4">04</option>
                    <option value="D5">05</option>
                    <option value="D6">06</option>
                    <option value="D7">07</option>
                    <option value="D8">08</option>
                    <option value="D9">09</option>
                    <option value="D10">10</option>
                    <option value="D11">11</option>
                    <option value="D12">12</option>
                    <option value="D13">13</option>
                    <option value="D14">14</option>
                    <option value="D15">15</option>
                    <option value="D16">16</option>
                    <option value="D17">17</option>
                    <option value="D18">18</option>
                    <option value="D19">19</option>
                    <option value="D20">20</option>
                    <option value="D21">21</option>
                    <option value="D22">22</option>
                    <option value="D23">23</option>
                    <option value="D24">24</option>
                    <option value="D25">25</option>
                    <option value="D26">26</option>
                    <option value="D27">27</option>
                    <option value="D28">28</option>
                    <option value="D29">29</option>
                    <option value="D30">30</option>
                    <option value="D31">31</option>
                    <option value="D32">32</option>
                    <option value="D33">33</option>
                    <option value="D34">34</option>
                    <option value="D35">35</option>
                    <option value="D36">36</option>
                    <option value="D37">37</option>
                    <option value="D38">38</option>
                    <option value="D39">39</option>
                    <option value="D40">40</option>
                    <option value="D41">41</option>
                    <option value="D42">42</option>
                    <option value="D43">43</option>
                    <option value="D44">44</option>
                    <option value="D45">45</option>
                    <option value="D46">46</option>
                    <option value="D47">47</option>
                    <option value="D48">48</option>
                    <option value="D49">49</option>
                    <option value="D50">50</option>
                    <option value="D51">51</option>
                    <option value="D52">52</option>
                    <option value="D53">53</option>
                    <option value="D54">54</option>
                    <option value="D55">55</option>
                    <option value="D56">56</option>
                    <option value="D57">57</option>
                    <option value="D58">58</option>
                    <option value="D59">59</option>
                </select>
            </div>
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-label" id="Thursday">
            <label class="form-check-label" for="Thursday">Thursday</label>
            <div class="form-group" style="padding-left:8px; padding-top:10px;">
                <select name="Hours" id="c1" class="form-control circle-select">
                    <option value=""> H </option>
                    <option value="D0">00</option>
                    <option value="D1">01</option>
                    <option value="D2">02</option>
                    <option value="D3">03</option>
                    <option value="D4">04</option>
                    <option value="D5">05</option>
                    <option value="D6">06</option>
                    <option value="D7">07</option>
                    <option value="D8">08</option>
                    <option value="D9">09</option>
                    <option value="D10">10</option>
                    <option value="D11">11</option>
                    <option value="D12">12</option>
                    <option value="D13">13</option>
                    <option value="D14">14</option>
                    <option value="D15">15</option>
                    <option value="D16">16</option>
                    <option value="D17">17</option>
                    <option value="D18">18</option>
                    <option value="D19">19</option>
                    <option value="D20">20</option>
                    <option value="D21">21</option>
                    <option value="D22">22</option>
                    <option value="D23">23</option>
                </select>
            </div>
            <span class="label label-default" style="padding-top: 10px;">:</span>
            <div class="form-group" style="padding-top: 10px;">
                <select name="Minutes" id="c2" class="form-control circle-select">
                    <option value=""> M </option>
                    <option value="D0">00</option>
                    <option value="D1">01</option>
                    <option value="D2">02</option>
                    <option value="D3">03</option>
                    <option value="D4">04</option>
                    <option value="D5">05</option>
                    <option value="D6">06</option>
                    <option value="D7">07</option>
                    <option value="D8">08</option>
                    <option value="D9">09</option>
                    <option value="D10">10</option>
                    <option value="D11">11</option>
                    <option value="D12">12</option>
                    <option value="D13">13</option>
                    <option value="D14">14</option>
                    <option value="D15">15</option>
                    <option value="D16">16</option>
                    <option value="D17">17</option>
                    <option value="D18">18</option>
                    <option value="D19">19</option>
                    <option value="D20">20</option>
                    <option value="D21">21</option>
                    <option value="D22">22</option>
                    <option value="D23">23</option>
                    <option value="D24">24</option>
                    <option value="D25">25</option>
                    <option value="D26">26</option>
                    <option value="D27">27</option>
                    <option value="D28">28</option>
                    <option value="D29">29</option>
                    <option value="D30">30</option>
                    <option value="D31">31</option>
                    <option value="D32">32</option>
                    <option value="D33">33</option>
                    <option value="D34">34</option>
                    <option value="D35">35</option>
                    <option value="D36">36</option>
                    <option value="D37">37</option>
                    <option value="D38">38</option>
                    <option value="D39">39</option>
                    <option value="D40">40</option>
                    <option value="D41">41</option>
                    <option value="D42">42</option>
                    <option value="D43">43</option>
                    <option value="D44">44</option>
                    <option value="D45">45</option>
                    <option value="D46">46</option>
                    <option value="D47">47</option>
                    <option value="D48">48</option>
                    <option value="D49">49</option>
                    <option value="D50">50</option>
                    <option value="D51">51</option>
                    <option value="D52">52</option>
                    <option value="D53">53</option>
                    <option value="D54">54</option>
                    <option value="D55">55</option>
                    <option value="D56">56</option>
                    <option value="D57">57</option>
                    <option value="D58">58</option>
                    <option value="D59">59</option>
                </select>
            </div>

            <span class="label label-default" style="padding-top: 10px;">--</span>


            <div class="form-group" style="padding-top: 10px;">
                <select name="Hours" id="c1" class="form-control circle-select">
                    <option value=""> H </option>
                    <option value="D0">00</option>
                    <option value="D1">01</option>
                    <option value="D2">02</option>
                    <option value="D3">03</option>
                    <option value="D4">04</option>
                    <option value="D5">05</option>
                    <option value="D6">06</option>
                    <option value="D7">07</option>
                    <option value="D8">08</option>
                    <option value="D9">09</option>
                    <option value="D10">10</option>
                    <option value="D11">11</option>
                    <option value="D12">12</option>
                    <option value="D13">13</option>
                    <option value="D14">14</option>
                    <option value="D15">15</option>
                    <option value="D16">16</option>
                    <option value="D17">17</option>
                    <option value="D18">18</option>
                    <option value="D19">19</option>
                    <option value="D20">20</option>
                    <option value="D21">21</option>
                    <option value="D22">22</option>
                    <option value="D23">23</option>
                </select>
            </div>
            <span class="label label-default" style="padding-top: 10px;">:</span>

            <div class="form-group" style="padding-top: 10px;">
                <select name="Minutes" id="c2" class="form-control circle-select">
                    <option value=""> M </option>
                    <option value="D0">00</option>
                    <option value="D1">01</option>
                    <option value="D2">02</option>
                    <option value="D3">03</option>
                    <option value="D4">04</option>
                    <option value="D5">05</option>
                    <option value="D6">06</option>
                    <option value="D7">07</option>
                    <option value="D8">08</option>
                    <option value="D9">09</option>
                    <option value="D10">10</option>
                    <option value="D11">11</option>
                    <option value="D12">12</option>
                    <option value="D13">13</option>
                    <option value="D14">14</option>
                    <option value="D15">15</option>
                    <option value="D16">16</option>
                    <option value="D17">17</option>
                    <option value="D18">18</option>
                    <option value="D19">19</option>
                    <option value="D20">20</option>
                    <option value="D21">21</option>
                    <option value="D22">22</option>
                    <option value="D23">23</option>
                    <option value="D24">24</option>
                    <option value="D25">25</option>
                    <option value="D26">26</option>
                    <option value="D27">27</option>
                    <option value="D28">28</option>
                    <option value="D29">29</option>
                    <option value="D30">30</option>
                    <option value="D31">31</option>
                    <option value="D32">32</option>
                    <option value="D33">33</option>
                    <option value="D34">34</option>
                    <option value="D35">35</option>
                    <option value="D36">36</option>
                    <option value="D37">37</option>
                    <option value="D38">38</option>
                    <option value="D39">39</option>
                    <option value="D40">40</option>
                    <option value="D41">41</option>
                    <option value="D42">42</option>
                    <option value="D43">43</option>
                    <option value="D44">44</option>
                    <option value="D45">45</option>
                    <option value="D46">46</option>
                    <option value="D47">47</option>
                    <option value="D48">48</option>
                    <option value="D49">49</option>
                    <option value="D50">50</option>
                    <option value="D51">51</option>
                    <option value="D52">52</option>
                    <option value="D53">53</option>
                    <option value="D54">54</option>
                    <option value="D55">55</option>
                    <option value="D56">56</option>
                    <option value="D57">57</option>
                    <option value="D58">58</option>
                    <option value="D59">59</option>
                </select>
            </div>
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-label" id="Friday">
            <label class="form-check-label" for="Friday">Friday</label>
            <div class="form-group" style="padding-left:8px; padding-top:10px;">
                <select name="Hours" id="c1" class="form-control circle-select">
                    <option value=""> H </option>
                    <option value="D0">00</option>
                    <option value="D1">01</option>
                    <option value="D2">02</option>
                    <option value="D3">03</option>
                    <option value="D4">04</option>
                    <option value="D5">05</option>
                    <option value="D6">06</option>
                    <option value="D7">07</option>
                    <option value="D8">08</option>
                    <option value="D9">09</option>
                    <option value="D10">10</option>
                    <option value="D11">11</option>
                    <option value="D12">12</option>
                    <option value="D13">13</option>
                    <option value="D14">14</option>
                    <option value="D15">15</option>
                    <option value="D16">16</option>
                    <option value="D17">17</option>
                    <option value="D18">18</option>
                    <option value="D19">19</option>
                    <option value="D20">20</option>
                    <option value="D21">21</option>
                    <option value="D22">22</option>
                    <option value="D23">23</option>
                </select>
            </div>
            <span class="label label-default" style="padding-top: 10px;">:</span>
            <div class="form-group" style="padding-top: 10px;">
                <select name="Minutes" id="c2" class="form-control circle-select">
                    <option value=""> M </option>
                    <option value="D0">00</option>
                    <option value="D1">01</option>
                    <option value="D2">02</option>
                    <option value="D3">03</option>
                    <option value="D4">04</option>
                    <option value="D5">05</option>
                    <option value="D6">06</option>
                    <option value="D7">07</option>
                    <option value="D8">08</option>
                    <option value="D9">09</option>
                    <option value="D10">10</option>
                    <option value="D11">11</option>
                    <option value="D12">12</option>
                    <option value="D13">13</option>
                    <option value="D14">14</option>
                    <option value="D15">15</option>
                    <option value="D16">16</option>
                    <option value="D17">17</option>
                    <option value="D18">18</option>
                    <option value="D19">19</option>
                    <option value="D20">20</option>
                    <option value="D21">21</option>
                    <option value="D22">22</option>
                    <option value="D23">23</option>
                    <option value="D24">24</option>
                    <option value="D25">25</option>
                    <option value="D26">26</option>
                    <option value="D27">27</option>
                    <option value="D28">28</option>
                    <option value="D29">29</option>
                    <option value="D30">30</option>
                    <option value="D31">31</option>
                    <option value="D32">32</option>
                    <option value="D33">33</option>
                    <option value="D34">34</option>
                    <option value="D35">35</option>
                    <option value="D36">36</option>
                    <option value="D37">37</option>
                    <option value="D38">38</option>
                    <option value="D39">39</option>
                    <option value="D40">40</option>
                    <option value="D41">41</option>
                    <option value="D42">42</option>
                    <option value="D43">43</option>
                    <option value="D44">44</option>
                    <option value="D45">45</option>
                    <option value="D46">46</option>
                    <option value="D47">47</option>
                    <option value="D48">48</option>
                    <option value="D49">49</option>
                    <option value="D50">50</option>
                    <option value="D51">51</option>
                    <option value="D52">52</option>
                    <option value="D53">53</option>
                    <option value="D54">54</option>
                    <option value="D55">55</option>
                    <option value="D56">56</option>
                    <option value="D57">57</option>
                    <option value="D58">58</option>
                    <option value="D59">59</option>
                </select>
            </div>

            <span class="label label-default" style="padding-top: 10px;">--</span>


            <div class="form-group" style="padding-top: 10px;">
                <select name="Hours" id="c1" class="form-control circle-select">
                    <option value=""> H </option>
                    <option value="D0">00</option>
                    <option value="D1">01</option>
                    <option value="D2">02</option>
                    <option value="D3">03</option>
                    <option value="D4">04</option>
                    <option value="D5">05</option>
                    <option value="D6">06</option>
                    <option value="D7">07</option>
                    <option value="D8">08</option>
                    <option value="D9">09</option>
                    <option value="D10">10</option>
                    <option value="D11">11</option>
                    <option value="D12">12</option>
                    <option value="D13">13</option>
                    <option value="D14">14</option>
                    <option value="D15">15</option>
                    <option value="D16">16</option>
                    <option value="D17">17</option>
                    <option value="D18">18</option>
                    <option value="D19">19</option>
                    <option value="D20">20</option>
                    <option value="D21">21</option>
                    <option value="D22">22</option>
                    <option value="D23">23</option>
                </select>
            </div>
            <span class="label label-default" style="padding-top: 10px;">:</span>

            <div class="form-group" style="padding-top: 10px;">
                <select name="Minutes" id="c2" class="form-control circle-select">
                    <option value=""> M </option>
                    <option value="D0">00</option>
                    <option value="D1">01</option>
                    <option value="D2">02</option>
                    <option value="D3">03</option>
                    <option value="D4">04</option>
                    <option value="D5">05</option>
                    <option value="D6">06</option>
                    <option value="D7">07</option>
                    <option value="D8">08</option>
                    <option value="D9">09</option>
                    <option value="D10">10</option>
                    <option value="D11">11</option>
                    <option value="D12">12</option>
                    <option value="D13">13</option>
                    <option value="D14">14</option>
                    <option value="D15">15</option>
                    <option value="D16">16</option>
                    <option value="D17">17</option>
                    <option value="D18">18</option>
                    <option value="D19">19</option>
                    <option value="D20">20</option>
                    <option value="D21">21</option>
                    <option value="D22">22</option>
                    <option value="D23">23</option>
                    <option value="D24">24</option>
                    <option value="D25">25</option>
                    <option value="D26">26</option>
                    <option value="D27">27</option>
                    <option value="D28">28</option>
                    <option value="D29">29</option>
                    <option value="D30">30</option>
                    <option value="D31">31</option>
                    <option value="D32">32</option>
                    <option value="D33">33</option>
                    <option value="D34">34</option>
                    <option value="D35">35</option>
                    <option value="D36">36</option>
                    <option value="D37">37</option>
                    <option value="D38">38</option>
                    <option value="D39">39</option>
                    <option value="D40">40</option>
                    <option value="D41">41</option>
                    <option value="D42">42</option>
                    <option value="D43">43</option>
                    <option value="D44">44</option>
                    <option value="D45">45</option>
                    <option value="D46">46</option>
                    <option value="D47">47</option>
                    <option value="D48">48</option>
                    <option value="D49">49</option>
                    <option value="D50">50</option>
                    <option value="D51">51</option>
                    <option value="D52">52</option>
                    <option value="D53">53</option>
                    <option value="D54">54</option>
                    <option value="D55">55</option>
                    <option value="D56">56</option>
                    <option value="D57">57</option>
                    <option value="D58">58</option>
                    <option value="D59">59</option>
                </select>
            </div>
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-label" id="Saturday">
            <label class="form-check-label" for="Saturday">Saturday</label>
            <div class="form-group" style="padding-left:8px; padding-top:10px;">
                <select name="Hours" id="c1" class="form-control circle-select">
                    <option value=""> H </option>
                    <option value="D0">00</option>
                    <option value="D1">01</option>
                    <option value="D2">02</option>
                    <option value="D3">03</option>
                    <option value="D4">04</option>
                    <option value="D5">05</option>
                    <option value="D6">06</option>
                    <option value="D7">07</option>
                    <option value="D8">08</option>
                    <option value="D9">09</option>
                    <option value="D10">10</option>
                    <option value="D11">11</option>
                    <option value="D12">12</option>
                    <option value="D13">13</option>
                    <option value="D14">14</option>
                    <option value="D15">15</option>
                    <option value="D16">16</option>
                    <option value="D17">17</option>
                    <option value="D18">18</option>
                    <option value="D19">19</option>
                    <option value="D20">20</option>
                    <option value="D21">21</option>
                    <option value="D22">22</option>
                    <option value="D23">23</option>
                </select>
            </div>
            <span class="label label-default" style="padding-top: 10px;">:</span>
            <div class="form-group" style="padding-top: 10px;">
                <select name="Minutes" id="c2" class="form-control circle-select">
                    <option value=""> M </option>
                    <option value="D0">00</option>
                    <option value="D1">01</option>
                    <option value="D2">02</option>
                    <option value="D3">03</option>
                    <option value="D4">04</option>
                    <option value="D5">05</option>
                    <option value="D6">06</option>
                    <option value="D7">07</option>
                    <option value="D8">08</option>
                    <option value="D9">09</option>
                    <option value="D10">10</option>
                    <option value="D11">11</option>
                    <option value="D12">12</option>
                    <option value="D13">13</option>
                    <option value="D14">14</option>
                    <option value="D15">15</option>
                    <option value="D16">16</option>
                    <option value="D17">17</option>
                    <option value="D18">18</option>
                    <option value="D19">19</option>
                    <option value="D20">20</option>
                    <option value="D21">21</option>
                    <option value="D22">22</option>
                    <option value="D23">23</option>
                    <option value="D24">24</option>
                    <option value="D25">25</option>
                    <option value="D26">26</option>
                    <option value="D27">27</option>
                    <option value="D28">28</option>
                    <option value="D29">29</option>
                    <option value="D30">30</option>
                    <option value="D31">31</option>
                    <option value="D32">32</option>
                    <option value="D33">33</option>
                    <option value="D34">34</option>
                    <option value="D35">35</option>
                    <option value="D36">36</option>
                    <option value="D37">37</option>
                    <option value="D38">38</option>
                    <option value="D39">39</option>
                    <option value="D40">40</option>
                    <option value="D41">41</option>
                    <option value="D42">42</option>
                    <option value="D43">43</option>
                    <option value="D44">44</option>
                    <option value="D45">45</option>
                    <option value="D46">46</option>
                    <option value="D47">47</option>
                    <option value="D48">48</option>
                    <option value="D49">49</option>
                    <option value="D50">50</option>
                    <option value="D51">51</option>
                    <option value="D52">52</option>
                    <option value="D53">53</option>
                    <option value="D54">54</option>
                    <option value="D55">55</option>
                    <option value="D56">56</option>
                    <option value="D57">57</option>
                    <option value="D58">58</option>
                    <option value="D59">59</option>
                </select>
            </div>

            <span class="label label-default" style="padding-top: 10px;">--</span>


            <div class="form-group" style="padding-top: 10px;">
                <select name="Hours" id="c1" class="form-control circle-select">
                    <option value=""> H </option>
                    <option value="D0">00</option>
                    <option value="D1">01</option>
                    <option value="D2">02</option>
                    <option value="D3">03</option>
                    <option value="D4">04</option>
                    <option value="D5">05</option>
                    <option value="D6">06</option>
                    <option value="D7">07</option>
                    <option value="D8">08</option>
                    <option value="D9">09</option>
                    <option value="D10">10</option>
                    <option value="D11">11</option>
                    <option value="D12">12</option>
                    <option value="D13">13</option>
                    <option value="D14">14</option>
                    <option value="D15">15</option>
                    <option value="D16">16</option>
                    <option value="D17">17</option>
                    <option value="D18">18</option>
                    <option value="D19">19</option>
                    <option value="D20">20</option>
                    <option value="D21">21</option>
                    <option value="D22">22</option>
                    <option value="D23">23</option>
                </select>
            </div>
            <span class="label label-default" style="padding-top: 10px;">:</span>

            <div class="form-group" style="padding-top: 10px;">
                <select name="Minutes" id="c2" class="form-control circle-select">
                    <option value=""> M </option>
                    <option value="D0">00</option>
                    <option value="D1">01</option>
                    <option value="D2">02</option>
                    <option value="D3">03</option>
                    <option value="D4">04</option>
                    <option value="D5">05</option>
                    <option value="D6">06</option>
                    <option value="D7">07</option>
                    <option value="D8">08</option>
                    <option value="D9">09</option>
                    <option value="D10">10</option>
                    <option value="D11">11</option>
                    <option value="D12">12</option>
                    <option value="D13">13</option>
                    <option value="D14">14</option>
                    <option value="D15">15</option>
                    <option value="D16">16</option>
                    <option value="D17">17</option>
                    <option value="D18">18</option>
                    <option value="D19">19</option>
                    <option value="D20">20</option>
                    <option value="D21">21</option>
                    <option value="D22">22</option>
                    <option value="D23">23</option>
                    <option value="D24">24</option>
                    <option value="D25">25</option>
                    <option value="D26">26</option>
                    <option value="D27">27</option>
                    <option value="D28">28</option>
                    <option value="D29">29</option>
                    <option value="D30">30</option>
                    <option value="D31">31</option>
                    <option value="D32">32</option>
                    <option value="D33">33</option>
                    <option value="D34">34</option>
                    <option value="D35">35</option>
                    <option value="D36">36</option>
                    <option value="D37">37</option>
                    <option value="D38">38</option>
                    <option value="D39">39</option>
                    <option value="D40">40</option>
                    <option value="D41">41</option>
                    <option value="D42">42</option>
                    <option value="D43">43</option>
                    <option value="D44">44</option>
                    <option value="D45">45</option>
                    <option value="D46">46</option>
                    <option value="D47">47</option>
                    <option value="D48">48</option>
                    <option value="D49">49</option>
                    <option value="D50">50</option>
                    <option value="D51">51</option>
                    <option value="D52">52</option>
                    <option value="D53">53</option>
                    <option value="D54">54</option>
                    <option value="D55">55</option>
                    <option value="D56">56</option>
                    <option value="D57">57</option>
                    <option value="D58">58</option>
                    <option value="D59">59</option>
                </select>
            </div>
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-label" id="Sunday">
            <label class="form-check-label" for="Sunday">Sunday</label>
            <div class="form-group" style="padding-left:8px; padding-top:10px;">
                <select name="Hours" id="c1" class="form-control circle-select">
                    <option value=""> H </option>
                    <option value="D0">00</option>
                    <option value="D1">01</option>
                    <option value="D2">02</option>
                    <option value="D3">03</option>
                    <option value="D4">04</option>
                    <option value="D5">05</option>
                    <option value="D6">06</option>
                    <option value="D7">07</option>
                    <option value="D8">08</option>
                    <option value="D9">09</option>
                    <option value="D10">10</option>
                    <option value="D11">11</option>
                    <option value="D12">12</option>
                    <option value="D13">13</option>
                    <option value="D14">14</option>
                    <option value="D15">15</option>
                    <option value="D16">16</option>
                    <option value="D17">17</option>
                    <option value="D18">18</option>
                    <option value="D19">19</option>
                    <option value="D20">20</option>
                    <option value="D21">21</option>
                    <option value="D22">22</option>
                    <option value="D23">23</option>
                </select>
            </div>
            <span class="label label-default" style="padding-top: 10px;">:</span>
            <div class="form-group" style="padding-top: 10px;">
                <select name="Minutes" id="c2" class="form-control circle-select">
                    <option value=""> M </option>
                    <option value="D0">00</option>
                    <option value="D1">01</option>
                    <option value="D2">02</option>
                    <option value="D3">03</option>
                    <option value="D4">04</option>
                    <option value="D5">05</option>
                    <option value="D6">06</option>
                    <option value="D7">07</option>
                    <option value="D8">08</option>
                    <option value="D9">09</option>
                    <option value="D10">10</option>
                    <option value="D11">11</option>
                    <option value="D12">12</option>
                    <option value="D13">13</option>
                    <option value="D14">14</option>
                    <option value="D15">15</option>
                    <option value="D16">16</option>
                    <option value="D17">17</option>
                    <option value="D18">18</option>
                    <option value="D19">19</option>
                    <option value="D20">20</option>
                    <option value="D21">21</option>
                    <option value="D22">22</option>
                    <option value="D23">23</option>
                    <option value="D24">24</option>
                    <option value="D25">25</option>
                    <option value="D26">26</option>
                    <option value="D27">27</option>
                    <option value="D28">28</option>
                    <option value="D29">29</option>
                    <option value="D30">30</option>
                    <option value="D31">31</option>
                    <option value="D32">32</option>
                    <option value="D33">33</option>
                    <option value="D34">34</option>
                    <option value="D35">35</option>
                    <option value="D36">36</option>
                    <option value="D37">37</option>
                    <option value="D38">38</option>
                    <option value="D39">39</option>
                    <option value="D40">40</option>
                    <option value="D41">41</option>
                    <option value="D42">42</option>
                    <option value="D43">43</option>
                    <option value="D44">44</option>
                    <option value="D45">45</option>
                    <option value="D46">46</option>
                    <option value="D47">47</option>
                    <option value="D48">48</option>
                    <option value="D49">49</option>
                    <option value="D50">50</option>
                    <option value="D51">51</option>
                    <option value="D52">52</option>
                    <option value="D53">53</option>
                    <option value="D54">54</option>
                    <option value="D55">55</option>
                    <option value="D56">56</option>
                    <option value="D57">57</option>
                    <option value="D58">58</option>
                    <option value="D59">59</option>
                </select>
            </div>

            <span class="label label-default" style="padding-top: 10px;">--</span>


            <div class="form-group" style="padding-top: 10px;">
                <select name="Hours" id="c1" class="form-control circle-select">
                    <option value=""> H </option>
                    <option value="D0">00</option>
                    <option value="D1">01</option>
                    <option value="D2">02</option>
                    <option value="D3">03</option>
                    <option value="D4">04</option>
                    <option value="D5">05</option>
                    <option value="D6">06</option>
                    <option value="D7">07</option>
                    <option value="D8">08</option>
                    <option value="D9">09</option>
                    <option value="D10">10</option>
                    <option value="D11">11</option>
                    <option value="D12">12</option>
                    <option value="D13">13</option>
                    <option value="D14">14</option>
                    <option value="D15">15</option>
                    <option value="D16">16</option>
                    <option value="D17">17</option>
                    <option value="D18">18</option>
                    <option value="D19">19</option>
                    <option value="D20">20</option>
                    <option value="D21">21</option>
                    <option value="D22">22</option>
                    <option value="D23">23</option>
                </select>
            </div>
            <span class="label label-default" style="padding-top: 10px;">:</span>

            <div class="form-group" style="padding-top: 10px;">
                <select name="Minutes" id="c2" class="form-control circle-select">
                    <option value=""> M </option>
                    <option value="D0">00</option>
                    <option value="D1">01</option>
                    <option value="D2">02</option>
                    <option value="D3">03</option>
                    <option value="D4">04</option>
                    <option value="D5">05</option>
                    <option value="D6">06</option>
                    <option value="D7">07</option>
                    <option value="D8">08</option>
                    <option value="D9">09</option>
                    <option value="D10">10</option>
                    <option value="D11">11</option>
                    <option value="D12">12</option>
                    <option value="D13">13</option>
                    <option value="D14">14</option>
                    <option value="D15">15</option>
                    <option value="D16">16</option>
                    <option value="D17">17</option>
                    <option value="D18">18</option>
                    <option value="D19">19</option>
                    <option value="D20">20</option>
                    <option value="D21">21</option>
                    <option value="D22">22</option>
                    <option value="D23">23</option>
                    <option value="D24">24</option>
                    <option value="D25">25</option>
                    <option value="D26">26</option>
                    <option value="D27">27</option>
                    <option value="D28">28</option>
                    <option value="D29">29</option>
                    <option value="D30">30</option>
                    <option value="D31">31</option>
                    <option value="D32">32</option>
                    <option value="D33">33</option>
                    <option value="D34">34</option>
                    <option value="D35">35</option>
                    <option value="D36">36</option>
                    <option value="D37">37</option>
                    <option value="D38">38</option>
                    <option value="D39">39</option>
                    <option value="D40">40</option>
                    <option value="D41">41</option>
                    <option value="D42">42</option>
                    <option value="D43">43</option>
                    <option value="D44">44</option>
                    <option value="D45">45</option>
                    <option value="D46">46</option>
                    <option value="D47">47</option>
                    <option value="D48">48</option>
                    <option value="D49">49</option>
                    <option value="D50">50</option>
                    <option value="D51">51</option>
                    <option value="D52">52</option>
                    <option value="D53">53</option>
                    <option value="D54">54</option>
                    <option value="D55">55</option>
                    <option value="D56">56</option>
                    <option value="D57">57</option>
                    <option value="D58">58</option>
                    <option value="D59">59</option>
                </select>
            </div>
        </div>

        <div class="form-control">
            <button type="submit" class="btn medium">
                <span>{{ __('Register') }}<span>
            </button>
            <span class="required-fields">* Required fields</span>
        </div>
    </form>
</div>

@endsection