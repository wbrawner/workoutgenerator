@extends('layouts.master')

@section('title', 'Generate')

@section('header')

@section('content')
<div class="content">
    <h1>Workout Generator</h1>
    <form method="post">
        <fieldset>
            <legend>Background Info:</legend>
            <label>What is your primary goal?:</label>
            <br />
            <br />
            <select>
                <option value="strength">Gain Strength</option>
                <option value="endurance">Gain Endurance</option>
                <option value="definition">Gain Definition</option>
            </select>
            <br />
            <br />
            <br />
            <label>Which of the following equipment/exercise styles do you have access to and enjoy doing? Check all that apply:</label>
            <br />
            <br />
            <input type="checkbox" id="free-weights" value="free-weights" onClick="control()">Free Weights
            <br />
            <input type="checkbox" id="dumbbells" value="dumbbells" disabled><span class="dtext">Dumbbells</span>
            <br />
            <input type="checkbox" id="barbells" value="barbells" disabled><span class="dtext">Barbells</span>
            <br />
            <input type="checkbox" value="selectorized">Selectorized Equipment
            <br />
            <input type="checkbox" value="cables">Cable Equipment
            <br />
            <input type="checkbox" value="calisthenics">Calisthenics
            <br />
            <br />
            <br />
            <label>How long have you consistently followed an exercise routine?</label>
            <br />
            <br />
            <select>
                <option>0 years</option>
                <option>1 year</option>
                <option>2+ years</option>
            </select>
            <select>
                <?php 
                for ($i = 0; $i <= 11; $i++) {
                    echo '<option>' . $i . ' months</option>'
                }
                ?>
            </select>
            <br />
            <br />
            <br />
            <label>How many days would you like to workout this week?</label>
            <br />
            <br />
            <select>
                <?php
                for ($i = 1; $i <= 6; $i++) {
                    echo '<option>' . $i . '</option>';
                }
                ?>
            </select>
            <br />
            <br />
            <button name="">Generate My Workout!</button>
        </fieldset>
    </form>
    <br />
</div>
<script>
var fw = document.getElementById("free-weights");
var db = document.getElementById("dumbbells");
var bb = document.getElementById("barbells");
var dtext = document.getElementsByClassName("dtext");
for (var i = 0; i < dtext.length; i++) {
    dtext[i].style.color = "#CCCCCC";
};
function control () {
    if (fw.checked === true) {
        db.disabled = false;
        bb.disabled = false;
    for (var i = 0; i < dtext.length; i++) {
        dtext[i].style.color = "#000000";
    };
    } else {
        db.disabled = true;
        bb.disabled = true;
        for (var i = 0; i < dtext.length; i++) {
            dtext[i].style.color = "#CCCCCC";
        };
    }
};
</script>
@endsection
