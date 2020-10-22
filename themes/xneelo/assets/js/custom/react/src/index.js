const {render, useState, useEffect} = wp.element;
import {News} from "./components/news";


if (document.getElementById(`react-news`)) {
    render(<News />, document.getElementById(`react-news`));
}
