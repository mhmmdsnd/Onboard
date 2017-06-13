function getStock(opts, complete) {
	var defs = {
		desc: false,
		baseURL: 'http://query.yahooapis.com/v1/public/yql?q=',
		query: 'select {display} from yahoo.finance.quotes where symbol in ({quotes}) | sort(field="{sortBy}", descending="{desc}")',
		suffixURL: '&env=store://datatables.org/alltableswithkeys&format=json&callback=?'
	};

	opts = $.extend({
		display: ['*'],
		stocks: []
	}, opts || {});

	if (!opts.stocks.length) {
		complete('No stock defined');
		return;
	}

	var query = {
		display: opts.display.join(', '),
		quotes: opts.stocks.map(function (stock) {
			return '"' + stock + '"';
		}).join(', ')
	};
	
	defs.query = defs.query
		.replace('{display}', query.display)
		.replace('{quotes}', query.quotes)
		.replace('{sortBy}', defs.sortBy)
		.replace('{desc}', defs.desc);

	defs.url = defs.baseURL + defs.query + defs.suffixURL;
	$.getJSON(defs.url, function (data) {
		var err = null;
		if (!data || !data.query) {
			err = true;
		}
		complete(err, !err && data.query.results);
	});
}

function reget(){
	getStock({
		stocks: ['IDR=X']
	}, function (err, data) {
		if (err) {
			alert('Error:' + error);
			return;
		}	
		$('.dts').html(data.quote.symbol);
		$('.dcurr').html(data.quote.Currency);
		$('.dvol').html(data.quote.Ask.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",").replace(/.0,000/g,""));
	});
	getStock({
		stocks: ['EUR=X']
	}, function (err, data) {
		if (err) {
			alert('Error:' + error);
			return;
		}	
		$('.dts1').html(data.quote.symbol);
		$('.dcurr1').html(data.quote.Currency);
		$('.dvol1').html(data.quote.Ask.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",").replace(/.0,000/g,""));
	});
	getStock({
		stocks: ['SGD=X']
	}, function (err, data) {
		if (err) {
			alert('Error:' + error);
			return;
		}	
		$('.dts2').html(data.quote.symbol);
		$('.dcurr2').html(data.quote.Currency);
		$('.dvol2').html(data.quote.Ask.toString().replace(/\B(?=(\d{0})+(?!\d))/g, ",").replace(/.0,000/g,""));
	});
	getStock({
		stocks: ['MYR=X']
	}, function (err, data) {
		if (err) {
			alert('Error:' + error);
			return;
		}	
		$('.dts3').html(data.quote.symbol);
		$('.dcurr3').html(data.quote.Currency);
		$('.dvol3').html(data.quote.Ask.toString().replace(/\B(?=(\d{0})+(?!\d))/g, ",").replace(/.0,000/g,""));
	});
	getStock({
		stocks: ['HKD=X']
	}, function (err, data) {
		if (err) {
			alert('Error:' + error);
			return;
		}	
		$('.dts4').html(data.quote.symbol);
		$('.dcurr4').html(data.quote.Currency);
		$('.dvol4').html(data.quote.Ask.toString().replace(/\B(?=(\d{0})+(?!\d))/g, ",").replace(/.0,000/g,""));
	});
	getStock({
		stocks: ['THB=X']
	}, function (err, data) {
		if (err) {
			alert('Error:' + error);
			return;
		}	
		$('.dts5').html(data.quote.symbol);
		$('.dcurr5').html(data.quote.Currency);
		$('.dvol5').html(data.quote.Ask.toString().replace(/\B(?=(\d{0})+(?!\d))/g, ",").replace(/.0,000/g,""));
	});
}

var get=setInterval(function () {reget()}, 1000);
reget();