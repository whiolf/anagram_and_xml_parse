# Anagrams Detection and XML Parser

## Sources
| Code source file  | Test source file |
| ------------- | ------------- |
| anagram.php  | anagram_test.php  |
| xml_to_csv.php  | xml_to_csv_test.php  |


## Testing
To simplify perception only main functions are tested. Without mocks.
For testing I've used PHPUnit 6.3.0 

In Data Provider it can be found all cases, which are used for testing.

My results of testing:
```bash
$ phpunit anagram_test.php 
PHPUnit 6.3.0 by Sebastian Bergmann and contributors.

...............                                                   15 / 15 (100%)

Time: 88 ms, Memory: 10.00MB

OK (15 tests, 15 assertions)
```

```bash
$ phpunit xml_to_csv_test.php 
PHPUnit 6.3.0 by Sebastian Bergmann and contributors.

.............                                                     13 / 13 (100%)

Time: 92 ms, Memory: 10.00MB

OK (13 tests, 13 assertions)
```

Input XML and output Csv for testing are situated in separated folders in **data_for_testing** directory.

## Particular Qualities
- Both functions support Unicode strings (In the data provider represented an Russian and Japanese examples)
- Accordingly to the task description I don't use double quotes in the CSV to frame strings. So pipes and CR,LF are removed.
- Punctuation and other signs ignored in anagrams detection function. Such strings are valid. 
- Digits in strings for anagrams detection function are considered invalid
- To simplify the code I didn't use Classes and Namespaces. 




