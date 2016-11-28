lis urlalias Filter
===
provides special urlaliasfilters 


lislanguage
---
appends a language tag to the urlalias
URL alias will look like :
   * someurlalias-[languageMapping]

configure mapping and applied classlist in site.ini.append.php

```
# only map languages if the mapping should be appendend
[lisurlalias]
LanguageMap[fre-FR]=fr
LanguageMap[eng-GB]=en

# classidentifiers of classes where the mapping should be appended
ApplyOnClass[]
ApplyOnClass[]=article
```

Installation
---
 - go to Setup -> Extensions (/setup/extensions)
 - activate the Extension **lisurlaliasfilter** 
 - configure site.ini.append.php as you need it


