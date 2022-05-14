function getBotResponse(input) {

    if (input == "where will i get calculator??") {
        return "Please check our Office category section. You will get your item there!";
    } else if (input == "where will i get pencils??") {
        return "Please check our School category section. You will get you item there!";
    } else if (input == "what are the trending products on the website?") {
        return "Office bag, white board, and many more are on sale!! Hurry up and go check our latest products section!!!";
    }
    else if (input == "show me school bags") {
        return "url(images/bag.png)";
    }

    // Simple responses
    if (input == "hello" || input == "hi" || input == "heyy" || input == "wassup") {
        return "Hello there!";
    } else if (input == "goodbye") {
        return "Talk to you later!";
    } else {
        return "Try asking something else!";
    }
}