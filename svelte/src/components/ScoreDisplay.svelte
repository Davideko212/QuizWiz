<script lang="ts">
    import { ConicGradient, type ConicStop } from '@skeletonlabs/skeleton';
    import { questions } from '../stores';
    import StarRating from 'svelte-star-rating';

    export let data: Array<number> = [];

    let amount: number = 0;
    let averageDiff: number = 0;
    let conicStops: ConicStop[];
    
    data.forEach(value => {
    	amount += value;
  	});

    $questions.forEach(value => {
		averageDiff += value["Schwierigkeit"];
	});
	averageDiff /= amount;

    conicStops = [
		{ color: 'rgba(102, 255, 102, 1)', start: 0, end: (data[0]/amount)*100 },
		{ color: 'rgba(255, 80, 80, 1)', start: (data[0]/amount)*100, end: ((data[0]/amount)*100 + (data[1]/amount)*100) },
		{ color: 'rgba(179, 179, 179, 1)', start: ((data[0]/amount)*100 + (data[1]/amount)*100), end: ((data[0]/amount)*100 + (data[1]/amount)*100 + (data[2]/amount)*100) }
	];

    const config = {
        emptyColor: "hsl(240, 80%, 85%)",
		fullColor: "#ff5900",
		size: 32
    };
</script>

<style>
    #container {
		display: flex;
		flex-direction: row;
		gap: 20px;
		justify-content: center;
  		align-items: center;
		margin: 20px;
	}

	#entry {
		display: flex;
		flex-direction: row;
		gap: 6px;
  		align-items: center;
		text-align: left;
	}

    #text {
        font-size: large;
    }

	#color {
		aspect-ratio: 1/1;
		width: 15px;
		height: 15px;
	}

    #info {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }
</style>

<div id="container">
    <div id="chart">
        <ConicGradient stops={conicStops} width="w-48" />
    </div>
    <div id="text">
        <p>Ergebnisse des Quizzes mit {amount} Fragen:</p>
        <div id="entry">
            <div id="color" style="background-color: rgba(102, 255, 102, 1);"></div>
            <p>{data[0]} richtig ({((data[0]/amount)*100).toFixed(2)}%)</p>
        </div>
        <div id="entry">
            <div id="color" style="background-color: rgba(255, 80, 80, 1);"></div>
            <p>{data[1]} falsch ({((data[1]/amount)*100).toFixed(2)}%)</p>
        </div>
        <div id="entry">
            <div id="color" style="background-color: rgba(179, 179, 179, 1);"></div>
            <p>{data[2]} unbeantwortet ({((data[2]/amount)*100).toFixed(2)}%)</p>
        </div>
    </div>
</div>
<div id="info">
    <p>Durchschnittliche Schwierigkeit der Fragen: {(averageDiff).toFixed(2)} / 10</p>
    <StarRating rating={averageDiff/2} {config} />
</div>