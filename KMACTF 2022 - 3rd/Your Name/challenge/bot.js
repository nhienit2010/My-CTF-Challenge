const puppeteer = require('puppeteer');

const browser_options = {
	headless: true,
	args: [
		'--no-sandbox',
		'--disable-background-networking',
		'--disable-default-apps',
		'--disable-extensions',
		'--disable-gpu',
		'--disable-sync',
		'--disable-translate',
		'--hide-scrollbars',
		'--metrics-recording-only',
		'--mute-audio',
		'--no-first-run',
		'--safebrowsing-disable-auto-update',
		'--js-flags=--noexpose_wasm,--jitless'
	]
};

const visitPage = async url => {
	const browser = await puppeteer.launch(browser_options);

	let context = await browser.createIncognitoBrowserContext();
	let page = await context.newPage();
	
	await page.setCookie({
		'name': 'Flag',
		'value': 'KMACTF{XSS_W1th_ReC4ptch4_4nd_d0m_cl0bb3r1ng}',
		'domain': '127.0.0.1'
	})

	await page.goto(url, {
		waitUntil: 'networkidle2'
	});

	await page.waitForTimeout(7000);
	await browser.close();
};

module.exports = { visitPage };