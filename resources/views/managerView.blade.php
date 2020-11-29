@extends('layouts.base')

@section('title','Manager View')

@section('main')

<div class="form widget widget-medium">
    <div class="widget-header title-only">
        <h2 class="widget-title">Opening dates and hours of the store</h2>
    </div>
    <form method="POST" class="form-inline">

        <div class="form-check">
            <input type="checkbox" class="form-check-label" id="Monday">
            <label class="form-check-label" for="Monday">Monday</label>

            <div class="form-group" style="padding-left:40px; padding-top:10px;">
                <select name="Hours" id="monday-opening-hour" class="form-control circle-select">
                    <option value=""> H </option>
                    <option value="00">00</option>
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                </select>
            </div>
            <span class="label label-default" style="padding-top: 10px;">:</span>
            <div class="form-group" style="padding-top: 10px;">
                <select name="Minutes" id="monday-opening-minutes" class="form-control circle-select">
                    <option value=""> M </option>
                    <option value="00">00</option>
                    <option value="01">05</option>
                    <option value="02">10</option>
                    <option value="03">15</option>
                    <option value="04">20</option>
                    <option value="05">25</option>
                    <option value="06">30</option>
                    <option value="07">35</option>
                    <option value="08">40</option>
                    <option value="09">45</option>
                    <option value="10">50</option>
                    <option value="11">55</option>
                </select>
            </div>

            <span class="label label-default" style="padding-top: 10px;">--</span>


            <div class="form-group" style="padding-top: 10px;">
                <select name="Hours" id="monday-closing-hours" class="form-control circle-select">
                    <option value=""> H </option>
                    <option value="00">00</option>
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                </select>
            </div>
            <span class="label label-default" style="padding-top: 10px;">:</span>

            <div class="form-group" style="padding-top: 10px;">
                <select name="Minutes" id="monday-closing-minutes" class="form-control circle-select">
                    <option value=""> M </option>
                    <option value="00">00</option>
                    <option value="01">05</option>
                    <option value="02">10</option>
                    <option value="03">15</option>
                    <option value="04">20</option>
                    <option value="05">25</option>
                    <option value="06">30</option>
                    <option value="07">35</option>
                    <option value="08">40</option>
                    <option value="09">45</option>
                    <option value="10">50</option>
                    <option value="11">55</option>
                </select>
            </div>
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-label" id="Tuesday">
            <label class="form-check-label" for="Tuesday">Tuesday</label>
            <div class="form-group" style="padding-left:36px; padding-top:10px;">
                <select name="Hours" id="tuesday-opening-hour" class="form-control circle-select">
                    <option value=""> H </option>
                    <option value="00">00</option>
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                </select>
            </div>
            <span class="label label-default" style="padding-top: 10px;">:</span>
            <div class="form-group" style="padding-top: 10px;">
                <select name="Minutes" id="tuesday-opening-minutes" class="form-control circle-select">
                    <option value=""> M </option>
                    <option value="00">00</option>
                    <option value="01">05</option>
                    <option value="02">10</option>
                    <option value="03">15</option>
                    <option value="04">20</option>
                    <option value="05">25</option>
                    <option value="06">30</option>
                    <option value="07">35</option>
                    <option value="08">40</option>
                    <option value="09">45</option>
                    <option value="10">50</option>
                    <option value="11">55</option>
                </select>
            </div>

            <span class="label label-default" style="padding-top: 10px;">--</span>


            <div class="form-group" style="padding-top: 10px;">
                <select name="Hours" id="-tuesday-closing-hours" class="form-control circle-select">
                    <option value=""> H </option>
                    <option value="00">00</option>
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                </select>
            </div>
            <span class="label label-default" style="padding-top: 10px;">:</span>

            <div class="form-group" style="padding-top: 10px;">
                <select name="Minutes" id="tuesday-closing-minutes" class="form-control circle-select">
                    <option value=""> M </option>
                    <option value="00">00</option>
                    <option value="01">05</option>
                    <option value="02">10</option>
                    <option value="03">15</option>
                    <option value="04">20</option>
                    <option value="05">25</option>
                    <option value="06">30</option>
                    <option value="07">35</option>
                    <option value="08">40</option>
                    <option value="09">45</option>
                    <option value="10">50</option>
                    <option value="11">55</option>
                </select>
            </div>
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-label" id="Wednesday">
            <label class="form-check-label" for="Wednesday">Wednesday</label>
            <div class="form-group" style="padding-left:8px; padding-top:10px;">
                <select name="Hours" id="wednesday-opening-hour" class="form-control circle-select">
                    <option value=""> H </option>
                    <option value="00">00</option>
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                </select>
            </div>
            <span class="label label-default" style="padding-top: 10px;">:</span>
            <div class="form-group" style="padding-top: 10px;">
                <select name="Minutes" id="wednesday-opening-minutes" class="form-control circle-select">
                    <option value=""> M </option>
                    <option value="00">00</option>
                    <option value="01">05</option>
                    <option value="02">10</option>
                    <option value="03">15</option>
                    <option value="04">20</option>
                    <option value="05">25</option>
                    <option value="06">30</option>
                    <option value="07">35</option>
                    <option value="08">40</option>
                    <option value="09">45</option>
                    <option value="10">50</option>
                    <option value="11">55</option>
                </select>
            </div>

            <span class="label label-default" style="padding-top: 10px;">--</span>


            <div class="form-group" style="padding-top: 10px;">
                <select name="Hours" id="wednesday-closing-hour" class="form-control circle-select">
                    <option value=""> H </option>
                    <option value="00">00</option>
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                </select>
            </div>
            <span class="label label-default" style="padding-top: 10px;">:</span>

            <div class="form-group" style="padding-top: 10px;">
                <select name="Minutes" id="wednesday-closing-minutes" class="form-control circle-select">
                    <option value=""> M </option>
                    <option value="00">00</option>
                    <option value="01">05</option>
                    <option value="02">10</option>
                    <option value="03">15</option>
                    <option value="04">20</option>
                    <option value="05">25</option>
                    <option value="06">30</option>
                    <option value="07">35</option>
                    <option value="08">40</option>
                    <option value="09">45</option>
                    <option value="10">50</option>
                    <option value="11">55</option>
                </select>
            </div>
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-label" id="Thursday">
            <label class="form-check-label" for="Thursday">Thursday</label>
            <div class="form-group" style="padding-left:27px; padding-top:10px;">
                <select name="Hours" id="thursday-opening-hour" class="form-control circle-select">
                    <option value=""> H </option>
                    <option value="00">00</option>
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                </select>
            </div>
            <span class="label label-default" style="padding-top: 10px;">:</span>
            <div class="form-group" style="padding-top: 10px;">
                <select name="Minutes" id="thursday-opening-minutes" class="form-control circle-select">
                    <option value=""> M </option>
                    <option value="00">00</option>
                    <option value="01">05</option>
                    <option value="02">10</option>
                    <option value="03">15</option>
                    <option value="04">20</option>
                    <option value="05">25</option>
                    <option value="06">30</option>
                    <option value="07">35</option>
                    <option value="08">40</option>
                    <option value="09">45</option>
                    <option value="10">50</option>
                    <option value="11">55</option>
                </select>
            </div>

            <span class="label label-default" style="padding-top: 10px;">--</span>


            <div class="form-group" style="padding-top: 10px;">
                <select name="Hours" id="thursday-closing-hour" class="form-control circle-select">
                    <option value=""> H </option>
                    <option value="00">00</option>
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                </select>
            </div>
            <span class="label label-default" style="padding-top: 10px;">:</span>

            <div class="form-group" style="padding-top: 10px;">
                <select name="Minutes" id="thursday-closing-minutes" class="form-control circle-select">
                    <option value=""> M </option>
                    <option value="00">00</option>
                    <option value="01">05</option>
                    <option value="02">10</option>
                    <option value="03">15</option>
                    <option value="04">20</option>
                    <option value="05">25</option>
                    <option value="06">30</option>
                    <option value="07">35</option>
                    <option value="08">40</option>
                    <option value="09">45</option>
                    <option value="10">50</option>
                    <option value="11">55</option>
                </select>
            </div>
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-label" id="Friday">
            <label class="form-check-label" for="Friday">Friday</label>
            <div class="form-group" style="padding-left:56px; padding-top:10px;">
                <select name="Hours" id="friday-opening-hour" class="form-control circle-select">
                    <option value=""> H </option>
                    <option value="00">00</option>
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                </select>
            </div>
            <span class="label label-default" style="padding-top: 10px;">:</span>
            <div class="form-group" style="padding-top: 10px;">
                <select name="Minutes" id="friday-opening-minutes" class="form-control circle-select">
                    <option value=""> M </option>
                    <option value="00">00</option>
                    <option value="01">05</option>
                    <option value="02">10</option>
                    <option value="03">15</option>
                    <option value="04">20</option>
                    <option value="05">25</option>
                    <option value="06">30</option>
                    <option value="07">35</option>
                    <option value="08">40</option>
                    <option value="09">45</option>
                    <option value="10">50</option>
                    <option value="11">55</option>
                </select>
            </div>

            <span class="label label-default" style="padding-top: 10px;">--</span>


            <div class="form-group" style="padding-top: 10px;">
                <select name="Hours" id="friday-closing-hour" class="form-control circle-select">
                    <option value=""> H </option>
                    <option value="00">00</option>
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                </select>
            </div>
            <span class="label label-default" style="padding-top: 10px;">:</span>

            <div class="form-group" style="padding-top: 10px;">
                <select name="Minutes" id="friday-closing-minutes" class="form-control circle-select">
                    <option value=""> M </option>
                    <option value="00">00</option>
                    <option value="01">05</option>
                    <option value="02">10</option>
                    <option value="03">15</option>
                    <option value="04">20</option>
                    <option value="05">25</option>
                    <option value="06">30</option>
                    <option value="07">35</option>
                    <option value="08">40</option>
                    <option value="09">45</option>
                    <option value="10">50</option>
                    <option value="11">55</option>
                </select>
            </div>
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-label" id="Saturday">
            <label class="form-check-label" for="Saturday">Saturday</label>
            <div class="form-group" style="padding-left:31px; padding-top:10px;">
                <select name="Hours" id="saturday-opening-hour" class="form-control circle-select">
                    <option value=""> H </option>
                    <option value="00">00</option>
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                </select>
            </div>
            <span class="label label-default" style="padding-top: 10px;">:</span>
            <div class="form-group" style="padding-top: 10px;">
                <select name="Minutes" id="saturday-opening-minutes" class="form-control circle-select">
                    <option value=""> M </option>
                    <option value="00">00</option>
                    <option value="01">05</option>
                    <option value="02">10</option>
                    <option value="03">15</option>
                    <option value="04">20</option>
                    <option value="05">25</option>
                    <option value="06">30</option>
                    <option value="07">35</option>
                    <option value="08">40</option>
                    <option value="09">45</option>
                    <option value="10">50</option>
                    <option value="11">55</option>
                </select>
            </div>

            <span class="label label-default" style="padding-top: 10px;">--</span>


            <div class="form-group" style="padding-top: 10px;">
                <select name="Hours" id="saturday-closing-hour" class="form-control circle-select">
                    <option value=""> H </option>
                    <option value="00">00</option>
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                </select>
            </div>
            <span class="label label-default" style="padding-top: 10px;">:</span>

            <div class="form-group" style="padding-top: 10px;">
                <select name="Minutes" id="saturday-closing-minutes" class="form-control circle-select">
                    <option value=""> M </option>
                    <option value="00">00</option>
                    <option value="01">05</option>
                    <option value="02">10</option>
                    <option value="03">15</option>
                    <option value="04">20</option>
                    <option value="05">25</option>
                    <option value="06">30</option>
                    <option value="07">35</option>
                    <option value="08">40</option>
                    <option value="09">45</option>
                    <option value="10">50</option>
                    <option value="11">55</option>
                </select>
            </div>
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-label" id="Sunday">
            <label class="form-check-label" for="Sunday">Sunday</label>
            <div class="form-group" style="padding-left:44px; padding-top:10px;">
                <select name="Hours" id="sunday-opening-hour" class="form-control circle-select">
                    <option value=""> H </option>
                    <option value="00">00</option>
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                </select>
            </div>
            <span class="label label-default" style="padding-top: 10px;">:</span>
            <div class="form-group" style="padding-top: 10px;">
                <select name="Minutes" id="sunday-opening-minutes" class="form-control circle-select">
                    <option value=""> M </option>
                    <option value="00">00</option>
                    <option value="01">05</option>
                    <option value="02">10</option>
                    <option value="03">15</option>
                    <option value="04">20</option>
                    <option value="05">25</option>
                    <option value="06">30</option>
                    <option value="07">35</option>
                    <option value="08">40</option>
                    <option value="09">45</option>
                    <option value="10">50</option>
                    <option value="11">55</option>
                </select>
            </div>

            <span class="label label-default" style="padding-top: 10px;">--</span>


            <div class="form-group" style="padding-top: 10px;">
                <select name="Hours" id="sunday-closing-hour" class="form-control circle-select">
                    <option value=""> H </option>
                    <option value="00">00</option>
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                </select>
            </div>
            <span class="label label-default" style="padding-top: 10px;">:</span>

            <div class="form-group" style="padding-top: 10px;">
                <select name="Minutes" id="sunday-closing-minutes" class="form-control circle-select">
                    <option value=""> M </option>
                    <option value="00">00</option>
                    <option value="01">05</option>
                    <option value="02">10</option>
                    <option value="03">15</option>
                    <option value="04">20</option>
                    <option value="05">25</option>
                    <option value="06">30</option>
                    <option value="07">35</option>
                    <option value="08">40</option>
                    <option value="09">45</option>
                    <option value="10">50</option>
                    <option value="11">55</option>
                </select>
            </div>
        </div>

        <div>
            <label for="MaxOccupancy" class="col-md-4 col-form-label text-md-right"><span
                    class="required-fields">*</span>{{ __('Max Occupancy') }}:</label><br />
            <input id="MaxOccupancy" type="text"
                class="form-control{{ $errors->has('MaxOccupancy') ? ' is-invalid' : '' }}" name="MaxOccupancy"
                value="{{ old('MaxOccupancy') }}" placeholder="Max Occupancy" required autofocus>
            @if ($errors->has('MaxOccupancy'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('MaxOccupancy') }}</strong>
            </span>
            @endif
        </div>

        <div>
            <label for="ReservationRatio" class="col-md-4 col-form-label text-md-right"><span
                    class="required-fields">*</span>{{ __('Reservation Ratio') }}:</label><br />
            <input id="ReservationRatio" type="text"
                class="form-control{{ $errors->has('ReservationRatio') ? ' is-invalid' : '' }}" name="ReservationRatio"
                value="{{ old('ReservationRatio') }}" placeholder="Reservation Ratio" required autofocus>
            @if ($errors->has('Reservation Ratio'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('ReservationRatio') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-control">
            <button type="submit" class="btn medium">
                <span>{{ __('Register') }}<span>
            </button>
        </div>
    </form>
</div>

@endsection
